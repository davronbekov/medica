<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 5/21/2019
 * Time: 3:12 PM
 */

namespace App\Core\Base;


class Constants
{

    //---------------------------------------------------------------
    //                      FOR API                                //
    //---------------------------------------------------------------

    /**
     * Basic
     */

    public static $API_DATA = 'data';
    public static $API_ID = 'id';
    public static $API_CODE = 'code';
    public static $API_MESSAGE = 'message';
    public static $API_LANGUAGE = 'language';
    public static $API_TOTAL_ITEMS = 'total_items';
    public static $API_ITEMS_PER_PAGE = 'items_per_page';
    public static $API_PARAMS = 'params';
    public static $API_FILES = 'files';

    public static $API_USER_AUTH = 'user';
    public static $API_USER_AUTH_API_TOKEN = 'api_token';
    public static $API_USER_NAME = 'name';
    public static $API_USER_EMAIL = 'email';
    public static $API_USER_PHONE = 'phone';
    public static $API_USER_TYPE = 'type';

    public static $API_HOSPITAL = 'hospital';
    public static $API_HOSPITALS = 'hospitals';
    public static $API_HOSPITALS_NAME = 'name';
    public static $API_HOSPITALS_KEYWORDS = 'keywords';
    public static $API_HOSPITALS_ADDRESS = 'address';

    public static $API_DOCTOR = 'doctor';
    public static $API_DOCTORS = 'doctors';
    public static $API_DOCTORS_NAME = 'name';
    public static $API_DOCTORS_EMAIL = 'email';
    public static $API_DOCTORS_PHONE = 'phone';
    public static $API_DOCTORS_JOB = 'job';
    public static $API_DOCTORS_ABOUT = 'about';

    public static $API_DOCTOR_REVIEWS = 'reviews';
    public static $API_DOCTOR_REVIEWS_USER_NAME = 'name';
    public static $API_DOCTOR_REVIEWS_MARK = 'mark';
    public static $API_DOCTOR_REVIEWS_COMMENTS = 'comments';


}