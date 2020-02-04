<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 6/16/2019
 * Time: 6:45 PM
 */

namespace App\Core\Base;

use App\Http\Controllers\Controller;

/**
 * Class Api
 * @package App\Core\Base
 *
 * @property-read int $code
 * @property-read String $message
 * @property-read String $language
 * @property-read String $subscription_status
 *
 * @property-read array $body
 * @property-read array $header
 *
 * @property-read array $languages
 * @property-read int $cache_time
 *
 * @property-read array $group_ids
 */
class Api extends Controller
{
    public function __construct()
    {
        //** SETTING LANGUAGE *//
        $this->language = request()->header('iLanguage', 'ru');

        if(!in_array($this->language, $this->languages))
            $this->language = 'ru';

        app()->setLocale($this->language);

    }

    protected $languages = [ 'en', 'ru', 'uz', ];
    protected $cache_time = 30; //minutes

    protected $code = 200;
    protected $message = "OK!";
    protected $language = 'ru';

    protected $body = [];
    protected $header = [];

    protected function setCode($code){
        $this->code = $code;
        $this->message = trans('codes.'.$code);
    }

    /**
     * @return array
     */
    protected function composeData(){
        $response = [];

        if(!empty($this->header)){
            foreach ($this->header as $key => $value){
                $response[$key] = $value;
            }
        }

        if(!empty($this->body)){
            foreach ($this->body as $key => $value){
                $response[Constants::$API_DATA][$key] = $value;
            }
        }

        return $response;

    }

    /**
     * @param array $data
     * @return array
     */
    protected function composeJson($data = []){
        $no_cache =  [
            Constants::$API_CODE => (int) $this->code,
            Constants::$API_MESSAGE => (String) $this->message,
            Constants::$API_LANGUAGE => (String) $this->language,
        ];

        $data = array_merge($no_cache, $data);

        return $data;
    }
}