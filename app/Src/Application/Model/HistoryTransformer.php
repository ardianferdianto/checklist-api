<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 22.27
 */

namespace Src\Application\Model;


use App\History;
use League\Fractal\TransformerAbstract;

class HistoryTransformer extends TransformerAbstract
{
    public function transform(History $history)
    {
        return $history->toArray();
    }
}