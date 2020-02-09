<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 09-Feb-20
 * Time: 1:26 PM
 */

namespace App\Core\Resources\Views;


use App\Core\Base\Constants;
use App\Core\Base\Resources;
use App\Core\Models\Hospitals;
use App\Core\Resources\Lists\DoctorsCollection;

class HospitalResource extends Resources
{
    public function toArray($request)
    {
        /**
         * @var HospitalResource|Hospitals $this
         */

        return [
            Constants::$API_HOSPITALS_NAME => $this->name,
            Constants::$API_HOSPITALS_KEYWORDS => $this->keywords,
            Constants::$API_HOSPITALS_ADDRESS => $this->address,

            Constants::$API_DOCTORS => new DoctorsCollection($this->relationDoctors),
        ];
    }
}