<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 31/08/19
 * Time: 23.56
 */

namespace Src\Application\Service;


use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Log;
use Src\Application\Repositories\ChecklistRepository;

class ChecklistService
{
    use Helpers;
    private $checklistRepo;
    /**
     * ChecklistService constructor.
     */
    public function __construct(ChecklistRepository $checklistRepository)
    {
        $this->checklistRepo = $checklistRepository;
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


}