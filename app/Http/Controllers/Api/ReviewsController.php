<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 09-Feb-20
 * Time: 2:37 PM
 */

namespace App\Http\Controllers\Api;


use App\Core\Base\Api;
use App\Core\Models\Doctor_reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewsController extends Api
{
    public function __construct()
    {
        parent::__construct();
    }

    public function actionAdd(Request $request){
        $validator = Validator::make($request->all(), [
            'doctor_id' => 'required',
            'mark' => 'required',
        ]);

        if($validator->fails()){
            $this->setCode(406);
            $this->setMessage($validator->errors()->first());
            return $this->composeJson();
        }

        $doctor_id = $request->input('doctor_id', null);
        $mark = $request->input('mark', 0);
        $comments = $request->input('comments', "");
        $user_id = $request->user()->id;

        /**
         * @var Doctor_reviews $doctor_reviews
         */
        $doctor_reviews = app(Doctor_reviews::class);
        $doctor_reviews = $doctor_reviews->insertItem([
            'doctor_id' => $doctor_id,
            'user_id' => $user_id,
            'mark' => $mark,
            'comments' => $comments,
        ]);

        if($doctor_reviews){
            $this->setCode(200);
            $this->setMessage("Successfully added");
            return $this->composeJson();
        }

        $this->setCode(500);
        $this->setMessage("Oops, there was an error");
        return $this->composeJson();
    }
}