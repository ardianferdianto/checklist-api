<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 14.51
 */

namespace Src\Application\EventListener;


use Illuminate\Support\Facades\Log;
use Src\Application\EventListener;
use Src\Application\Repositories\ChecklistRepository;
use Src\Application\Repositories\HistoryRepository;

class ChecklistDataUpdater extends EventListener
{
    private $history;
    private $checklistRepository;

    const TYPE = 'checklist';

    /**
     * ChecklistDataUpdater constructor.
     */
    public function __construct(HistoryRepository $history, ChecklistRepository $checklistRepository)
    {
        $this->history = $history;
        $this->checklistRepository = $checklistRepository;
    }

    public function whenChecklistWasCreated($event)
    {
        $checklist = $this->checklistRepository->ofId($event->getId());

        $this->history->store(self::TYPE, $checklist->id, "Create", "Created {$checklist->id}");
        Log::info("Checklist Created {$checklist->id}");

    }
}