<?php

namespace App\Http\Controllers\V1;

use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Src\Application\Model\ChecklistTransformer;
use Src\Application\Service\ChecklistService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ChecklistController extends Controller
{
    use Helpers;

    private $checklistService;
    /**
     * ChecklistController constructor.
     */
    public function __construct(ChecklistService $checklistService)
    {
        $this->checklistService = $checklistService;
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
}
