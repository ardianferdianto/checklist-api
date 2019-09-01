<?php

namespace App\Http\Controllers\V1;

use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Src\Application\Model\ChecklistTransformer;
use Src\Application\Repositories\ChecklistRepository;
use Src\Application\Service\ChecklistService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ChecklistController extends Controller
{
    use Helpers;

    private $checklistService;
    private $checklistRepository;
    /**
     * ChecklistController constructor.
     */
    public function __construct(ChecklistService $checklistService, ChecklistRepository $checklistRepository)
    {
        $this->checklistService = $checklistService;
        $this->checklistRepository = $checklistRepository;
    }

    public function index(Request $request)
    {
        $params = $request->all();

        $page = isset($params['page']) ? $params['page'] : 1;
        $page_limit = isset($params['page_limit']) ? $params['page_limit'] : 10;

        $checklists = $this->checklistRepository->findAllPaginate($page, $page_limit);

        return $this->response->paginator($checklists, new ChecklistTransformer, ['key' => 'checklist']);
    }

    public function get($id)
    {
        $checklist = $this->checklistService->getChecklist($id);

        if(!$checklist) {
            throw new NotFoundHttpException('Checklist not found');
        }

        return $this->response->item($checklist, new ChecklistTransformer, ['key' => 'checklist']);
    }

    public function store(Request $request)
    {
        $request = $request->json()->all();

        $handleRequest = $this->checklistService->storeChecklist($request["data"]['attributes']);

        if(is_array($handleRequest)) {
            return $this->response->errorInternal('Server Error');

        }

        return $this->response->item($handleRequest, new ChecklistTransformer, ['key' => 'checklist'])->setStatusCode(201);
    }

    public function update(Request $request, $id)
    {
        $request = $request->json()->all();

        try{
            $handleRequest = $this->checklistService->updateChecklist($id, $request["data"]['attributes']);
        }
        catch (ModelNotFoundException $e)
        {
            throw new NotFoundHttpException('Checklist not found');
        }

        if(is_array($handleRequest)) {
            return $this->response->errorInternal('Server Error');

        }

        return $this->response->item($handleRequest, new ChecklistTransformer, ['key' => 'checklist']);

    }

    public function delete($id)
    {
        $checklist = $this->checklistService->getChecklist($id);

        if(!$checklist) {
            throw new NotFoundHttpException('Checklist not found');
        }

        $this->checklistService->deleteChecklist($id);

        return $this->response->noContent()->setStatusCode(204);

    }
}
