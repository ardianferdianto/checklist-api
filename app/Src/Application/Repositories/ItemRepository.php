<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 20.58
 */

namespace Src\Application\Repositories;


use App\Item;

class ItemRepository
{
    private $repo;

    /**
     * ItemRepository constructor.
     * @param $repo
     */
    public function __construct(Item $item)
    {
        $this->repo = $item;
    }




}