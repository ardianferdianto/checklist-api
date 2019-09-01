<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 14.46
 */

namespace Src\Application;


use Illuminate\Support\ServiceProvider;

class ApplicationServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {

        $listeners = config('checklist.eventListeners');
        $dispatcher = app()->make('events');
        foreach ($listeners as $key=>$val) {
            if (!is_array($val)) {
                $val = [$val];
            }

            foreach ($val as $item) {
                $dispatcher->listen($key, $item);
            }
        }
    }
}