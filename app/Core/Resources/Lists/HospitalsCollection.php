<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 09-Feb-20
 * Time: 1:05 PM
 */

namespace App\Core\Resources\Lists;


use App\Core\Base\Collections;
use App\Core\Base\Constants;
use App\Core\Models\Hospitals;

class HospitalsCollection extends Collections
{
    public function toArray($request)
    {
        return $this->collection->transform(function ($items){
            /**
             * @var Hospitals|HospitalsCollection $items
             */
            return [
                Constants::$API_ID => $items->id,
                Constants::$API_HOSPITALS_NAME => $items->name,
                Constants::$API_HOSPITALS_KEYWORDS => $items->keywords,
            ];
        });
    }
}