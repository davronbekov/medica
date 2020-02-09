<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 09-Feb-20
 * Time: 12:50 PM
 */

namespace App\Http\Controllers\Api;


use App\Core\Base\Api;
use App\Core\Base\Constants;
use App\Core\Models\Hospitals;
use App\Core\Resources\Lists\HospitalsCollection;
use App\Core\Resources\Views\HospitalResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HospitalsController extends Api
{
    public function __construct()
    {
        parent::__construct();
    }

    public function actionList(Request $request){
        /**
         * @var Hospitals $hospitals
         */
        $hospitals = app(Hospitals::class);
        $hospitals->total_items = $request->input('items', 18);
        $hospitals = $hospitals->getItems();

        $this->body = [
            Constants::$API_TOTAL_ITEMS => (int) $hospitals->total(),
            Constants::$API_ITEMS_PER_PAGE => (int) $request->input('items', 18),
            Constants::$API_HOSPITALS => new HospitalsCollection($hospitals),
        ];

        return $this->composeJson($this->composeData());
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
         * @var Hospitals $hospitals
         */
        $hospitals = app(Hospitals::class);
        $hospitals = $hospitals->getItem($request->input('id', null));

        if(is_null($hospitals)){
            $this->setCode(404);
            $this->setMessage("not found");
            return $this->composeJson();
        }

        $this->body = [
            Constants::$API_HOSPITAL => new HospitalResource($hospitals),
        ];

        return $this->composeJson($this->composeData());
    }
}