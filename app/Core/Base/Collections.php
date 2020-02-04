<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 5/21/2019
 * Time: 3:18 PM
 */

namespace App\Core\Base;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class Collections
 * @package App\Core\Base
 *
 * @property String $language
 * @property array $group_ids
 * @property array $fields
 */
class Collections extends ResourceCollection
{
    public $language = 'ru';
    public $group_ids = [];
    public $fields = [];

    protected function isNew($time) : bool {
        $days = 3;
        $timestamp = $days*86400 + $time;

        if($timestamp >= time()) return true;
        else return false;
    }

    protected function getCurrency(){
        if(Strings::isEqual('ru', $this->language))
            return ' сум';
        elseif(Strings::isEqual('en', $this->language))
            return ' uzs';
        else
            return ' so\'m';
    }

    protected function getHumanReadableDays($days = 0){
        if($days >= 11 && $days <= 14){
            $days = $days." ".trans('tariffs.days3');
        }
        else{
            switch ($days%10){
                case '1':
                    $days = $days." ".trans('tariffs.days1');
                    break;
                case '2':
                case '3':
                case '4':
                    $days = $days." ".trans('tariffs.days2');
                    break;
                default:
                    $days = $days." ".trans('tariffs.days3');
                    break;
            }
        }

        return $days;
    }
}