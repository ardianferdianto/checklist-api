<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 31/08/19
 * Time: 23.56
 */

namespace Src\Application\Service;


use App\Checklist;
use Dingo\Api\Routing\Helpers;
use http\Env\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Src\Application\EventDispatcher;
use Src\Application\Repositories\ChecklistRepository;

class ChecklistService
{
    use Helpers;
    private $checklistRepo;
    private $eventDispatcher;

    public static $RULES = [
        'object_domain' => 'required|string',
        'object_id' => 'required|numeric',
        'description' => 'required|string',
        'is_completed' => 'boolean',
        'due' => 'date',
        'urgency' => 'numeric',
        'completed_at'=> 'date',
        'last_update_by' => 'string',
    ];
    /**
     * ChecklistService constructor.
     */
    public function __construct(ChecklistRepository $checklistRepository, EventDispatcher $eventDispatcher)
    {
        $this->checklistRepo = $checklistRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function getChecklist($id)
    {
        try{
            $data = $this->checklistRepo->ofId($id);
        }
        catch (\Exception $e)
        {
            Log::info('Model for Checklist id '.$id.' Not Found');
            return false;
        }
        return $data;
    }

    public function storeChecklist(array $request)
    {
        $validator = Validator::make($request, self::$RULES);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        list($event, $checklist) = $this->checklistRepo->store($request);
        $this->eventDispatcher->dispatch($event->releaseEvents());

        return $checklist;
    }

    public function updateChecklist($id, array $params)
    {
        $model = $this->checklistRepo->ofId($id);

        $validator = Validator::make($params, self::$RULES);

        if ($validator->fails()) {
            return $validator->errors()->all();
        }

        list($event, $checklist) = $this->checklistRepo->update($model, $params);
        $this->eventDispatcher->dispatch($event->releaseEvents());

        return $checklist;

    }

    public function deleteChecklist($id){

        $event = $this->checklistRepo->delete($id);

        $this->eventDispatcher->dispatch($event->releaseEvents());
    }

}