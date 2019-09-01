<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 00.02
 */

namespace Src\Application\Repositories;


use App\Checklist;
use Src\Application\Event\ChecklistWasCreated;
use Src\Application\EventGenerator;

class ChecklistRepository
{
    use EventGenerator;
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

    public function store(array $properties)
    {
        $model = $this->checklist->newInstance();

        $model->create($properties);
        $this->raise(new ChecklistWasCreated($model->id));

        return $this;
    }
}