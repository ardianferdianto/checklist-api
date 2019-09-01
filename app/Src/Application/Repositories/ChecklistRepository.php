<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 00.02
 */

namespace Src\Application\Repositories;


use App\Checklist;

class ChecklistRepository
{

    private $checklist;
    /**
     * ChecklistRepository constructor.
     */
    public function __construct()
    {
        $this->checklist = new Checklist;
    }

    public function ofId($id)
    {
        return $this->checklist->findOrFail($id);
    }
}