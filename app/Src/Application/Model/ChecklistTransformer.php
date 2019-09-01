<?php
/**
 * Created by PhpStorm.
 * User: ardianferdianto
 * Date: 01/09/19
 * Time: 13.23
 */

namespace Src\Application\Model;


use App\Checklist;
use League\Fractal\TransformerAbstract;

class ChecklistTransformer extends TransformerAbstract
{
    public function transform(Checklist $checklist)
    {

        /*$data = [
            "type" => "checklist",
            "id" => (string)$checklist->id,
            "attributes" => [
                $checklist->toArray()
            ],
            "links" => [
                "self" => '/checklists/'.$checklist->id
            ]
        ];*/

        return $checklist->toArray();
    }
}