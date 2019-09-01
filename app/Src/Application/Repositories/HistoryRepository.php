<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 22.28
 */

namespace Src\Application\Repositories;


use App\History;

class HistoryRepository
{
    private $repo;

    /**
     * HistoryRepository constructor.
     * @param $repo
     */
    public function __construct(History $history)
    {
        $this->repo = $history;
    }

    public function store($type, $loggable_id, $action, $value, $kwuid = null)
    {
        $model = $this->repo->newInstance();

        $checklist = $model->create([
            'loggable_type' => $type,
            'loggable_id' => $loggable_id,
            'action' => $action,
            'value' => $value,
            'kwuid' => $kwuid,
        ]);
    }


}