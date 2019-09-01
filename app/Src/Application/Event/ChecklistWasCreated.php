<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 15.39
 */

namespace Src\Application\Event;


class ChecklistWasCreated
{
    private $id;
    /**
     * ChecklistWasCreated constructor.
     */
    public function __construct($id)
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}