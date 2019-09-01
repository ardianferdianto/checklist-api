<?php

namespace App\Http\Controllers\V1;

use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Routing\Helpers;
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
}