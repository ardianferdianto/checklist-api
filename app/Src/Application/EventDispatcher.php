<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 14.49
 */

namespace Src\Application;


use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Log;

class EventDispatcher {

    /**
     * @var Dispatcher
     */
    private $dispatcher;


    public function __construct(Dispatcher $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function dispatch(array $events) {
        foreach ($events as $event) {

            $eventName = $this->getEventName($event);
            try {
                $this->dispatcher->dispatch($eventName, $event);
                Log::info("Event was dispatched [$eventName]");

            } catch (\Exception $exc) {
                Log::error("Fail dispatching event [$eventName]: " . $exc->getMessage());
            }
        }
    }

    /**
     * @param $event
     * @return mixed
     */
    protected function getEventName($event) {
        $eventName = str_replace('\\', '.', get_class($event));

        return $eventName;
    }
}