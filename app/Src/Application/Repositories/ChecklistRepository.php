<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 00.02
 */

namespace Src\Application\Repositories;


use App\Checklist;
use Illuminate\Pagination\Paginator;
use Src\Application\Event\ChecklistWasCreated;
use Src\Application\Event\ChecklistWasDeleted;
use Src\Application\Event\ChecklistWasUpdated;
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

    public function findAllPaginate($page = 1, $limit = 10)
    {
        Paginator::currentPageResolver(function () use ($page) {
            return $page;
        });

        $data = $this->checklist->paginate($limit);

        return $data;
    }
    public function ofId($id)
    {
        return $this->checklist->findOrFail($id);
    }

    public function store(array $properties)
    {
        $model = $this->checklist->newInstance();

        $checklist = $model->create($properties);
        $this->raise(new ChecklistWasCreated($checklist->id));

        return [$this, $checklist];
    }

    public function update(Checklist $model, array $properties)
    {
        $model->update($properties);

        $this->raise(new ChecklistWasUpdated($model->id));

        return [$this, $model];
    }

    public function delete($id)
    {
        $this->checklist->where('id', $id)->delete();

        $this->raise(new ChecklistWasDeleted($id));

        return $this;
    }
}