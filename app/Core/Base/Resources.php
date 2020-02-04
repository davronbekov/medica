<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 5/21/2019
 * Time: 3:18 PM
 */

namespace App\Core\Base;


use App\Core\Network\Requests;
use App\Http\Controllers\Library\Abonent;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Resources
 * @package App\Core\Base
 * @property String $language
 * @property array $group_ids
 * @property array $fields
 */
class Resources extends JsonResource
{
    public $language = 'ru';
    public $group_ids = [];
    public $fields = [];

    protected function getSubscriptionRequiredUrl(){
        $protocol = Requests::isSecureConnection() ? 'https://' : 'http://';
        return $protocol.'files.itv.uz/assets/help/subscription_needed.mp4';
    }

    protected function getCurrency(){
        if(Strings::isEqual('ru', $this->language))
            return ' сум';
        elseif(Strings::isEqual('en', $this->language))
            return ' uzs';
        else
            return ' so\'m';
    }
}