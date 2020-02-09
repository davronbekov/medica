<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 09-Feb-20
 * Time: 2:10 PM
 */

namespace App\Core\Resources\Views;

use App\Core\Resources\Lists\DoctorReviewsCollection;
use App\Core\Base\Constants;
use App\Core\Base\Resources;
use App\Core\Models\Doctors;

class DoctorResource extends Resources
{
    public function toArray($request)
    {
        /**
         * @var Doctors|DoctorResource $this
         */

        return [
            Constants::$API_DOCTORS_NAME => $this->relationUsers->name,
            Constants::$API_DOCTORS_EMAIL => $this->relationUsers->email,
            Constants::$API_DOCTORS_PHONE => $this->relationUsers->phone,
            Constants::$API_DOCTORS_JOB => $this->job,
            Constants::$API_DOCTORS_ABOUT => $this->about,

            Constants::$API_DOCTOR_REVIEWS => new DoctorReviewsCollection($this->relationReviews),
        ];
    }
}