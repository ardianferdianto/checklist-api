<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 17.19
 */

namespace Src\Application\Event;


class ChecklistWasUpdated
{
    private $id;

    /**
     * ChecklistWasUpdated constructor.
     * @param $id
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