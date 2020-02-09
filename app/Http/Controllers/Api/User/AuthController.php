<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 04-Feb-20
 * Time: 8:36 PM
 */

namespace App\Http\Controllers\Api\User;

use App\Core\Base\Api;
use App\Core\Base\Constants;
use App\Core\Resources\User\InfoResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Api
{
    public function __construct()
    {
        parent::__construct();
    }

    public function actionFailed(){
        $this->setCode(401);
        $this->setMessage('Authentication required');
        return $this->composeJson();
    }

    public function actionLogin(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            $this->setCode(406);
            $this->setMessage($validator->errors()->first());
            return $this->composeJson();
        }

        $email = $request->input('email');
        $password = $request->input('password');

        /**
         * @var User $user
         */
        $user = app(User::class);
        $user = $user->validateUserAuth($email, $password);
        if(is_null($user)){
            $this->setCode(406);
            $this->setMessage('Login or password incorrect');
            return $this->composeJson();
        }

        $user->updateApiToken();

        $this->body = [
            Constants::$API_USER_AUTH => new InfoResource($user),
        ];

        return $this->composeJson($this->composeData());
    }

    public function actionLogout(Request $request){
        $user = $request->user();
        $isLoggedOut = $user->logout();

        if($isLoggedOut){
            $this->setCode(200);
            $this->setMessage('Successfully logged out');
            return $this->composeJson();
        }

        $this->setCode(500);
        $this->setMessage('Oops! Something went wrong');
        return $this->composeJson();
    }

    public function actionRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'phone' => 'required',
        ]);

        if($validator->fails()){
            $this->setCode(406);
            $this->setMessage($validator->errors()->first());
            return $this->composeJson();
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $phone = $request->input('phone');

        /**
         * @var User $user
         */
        $user = app(User::class);
        $check = $user->register([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone
        ]);

        if($check){
            $user->updateApiToken();

            $this->body = [
                Constants::$API_USER_AUTH => new InfoResource($user),
            ];

            return $this->composeJson($this->composeData());
        }

        $this->setCode(500);
        $this->setMessage('Oops! Something went wrong');
        return $this->composeJson();
    }
}