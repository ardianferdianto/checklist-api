<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 14.49
 */

namespace Src\Application;


use Illuminate\Support\Facades\Log;

class EventListener
{
    public function handle($eventName, $event) {
        $event = $event[0];
        $eventName = $this->getEventName($event);
        $methodName = $this->getMethodName($eventName);

        if ($this->isListenerExists($methodName)) {
            Log::info("Calling listener method [$methodName] for event [$eventName] on class " . get_class($this));
            call_user_func([$this, $methodName], $event);
        }
    }

    /**
     * @param $event
     * @return mixed
     */
    private function getEventName($event) {
        $eventName = (new \ReflectionClass($event))->getShortName();

        return $eventName;
    }

    /**
     * @param $eventName
     * @return string
     */
    private function getMethodName($eventName) {
        $methodName = "when{$eventName}";

        return $methodName;
    }

    /**
     * @param $methodName
     * @return mixed
     */
    private function isListenerExists($methodName) {
        return method_exists($this, $methodName);
    }
}