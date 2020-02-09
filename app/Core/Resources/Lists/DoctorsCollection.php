<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 09-Feb-20
 * Time: 1:20 PM
 */

namespace App\Core\Resources\Lists;


use App\Core\Base\Collections;
use App\Core\Base\Constants;
use App\Core\Models\Doctors;

class DoctorsCollection extends Collections
{
    public function toArray($request)
    {
        return $this->collection->transform(function ($items){
            /**
             * @var Doctors|DoctorsCollection $items
             */
            return [
                Constants::$API_ID => $items->user_id,
                Constants::$API_DOCTORS_NAME => $items->relationUsers->name,
                Constants::$API_DOCTORS_EMAIL => $items->relationUsers->email,
            ];
        });
    }
}