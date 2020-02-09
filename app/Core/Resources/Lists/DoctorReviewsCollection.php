<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 09-Feb-20
 * Time: 2:18 PM
 */

namespace App\Core\Resources\Lists;


use App\Core\Base\Collections;
use App\Core\Base\Constants;
use App\Core\Models\Doctor_reviews;

class DoctorReviewsCollection extends Collections
{
    public function toArray($request)
    {
        return $this->collection->transform(function ($items){
            /**
             * @var Doctor_reviews|DoctorReviewsCollection $items
             */
            return [
                Constants::$API_DOCTOR_REVIEWS_USER_NAME => $items->relationUsers->name,
                Constants::$API_DOCTOR_REVIEWS_MARK => $items->mark,
                Constants::$API_DOCTOR_REVIEWS_COMMENTS => $items->comments
            ];
        });
    }
}