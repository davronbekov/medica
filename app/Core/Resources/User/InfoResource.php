<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 09-Feb-20
 * Time: 1:00 PM
 */

namespace App\Core\Resources\User;


use App\Core\Base\Constants;
use App\Core\Base\Resources;
use App\User;

class InfoResource extends Resources
{
    public function toArray($request)
    {
        /**
         * @var User|InfoResource $this
         */

        return [
            Constants::$API_USER_NAME => $this->name,
            Constants::$API_USER_EMAIL => $this->email,
            Constants::$API_USER_PHONE => $this->phone,
            Constants::$API_USER_TYPE => $this->getUserType(),
            Constants::$API_USER_AUTH_API_TOKEN => $this->api_token,
        ];
    }
}