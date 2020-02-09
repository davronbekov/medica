<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 09-Feb-20
 * Time: 1:38 PM
 */

namespace App\Http\Controllers\Api;


use App\Core\Base\Api;
use App\Core\Base\Constants;
use App\Core\Models\Doctors;
use App\Core\Resources\Views\DoctorResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DoctorsController extends Api
{
    public function __construct()
    {
        parent::__construct();
    }

    public function actionShow(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if($validator->fails()){
            $this->setCode(406);
            $this->setMessage($validator->errors()->first());
            return $this->composeJson();
        }

        /**
         * @var Doctors $doctors
         */
        $doctors = app(Doctors::class);
        $doctors = $doctors->getItem($request->input('id', null));
        if(is_null($doctors)){
            $this->setCode(404);
            $this->setMessage("not found");
            return $this->composeJson();
        }

        $this->body = [
            Constants::$API_DOCTOR => new DoctorResource($doctors),
        ];

        return $this->composeJson($this->composeData());
    }
}