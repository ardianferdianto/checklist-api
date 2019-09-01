<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 15.00
 */

namespace Src\Application;


trait EventGenerator
{
    protected $pendingEvents = [];

    public function raise($event) {
        $this->pendingEvents[] = $event;
    }

    public function releaseEvents() {
        $events = $this->pendingEvents;
        $this->pendingEvents = [];

        return $events;
    }
}