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
            Constants::$API_USER_AUTH => [
                Constants::$API_USER_NAME => $user->name,
                Constants::$API_USER_EMAIL => $user->email,
                Constants::$API_USER_PHONE => $user->phone,
                Constants::$API_USER_TYPE => $user->getUserType(),
                Constants::$API_USER_AUTH_API_TOKEN => $user->api_token,
            ],
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
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            $this->setCode(406);
            $this->setMessage($validator->errors()->first());
            return $this->composeJson();
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        /**
         * @var User $user
         */
        $user = app(User::class);
        $check = $user->register([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        if($check){
            $user->updateApiToken();

            $this->body = [
                Constants::$API_USER_AUTH => [
                    Constants::$API_USER_NAME => $user->name,
                    Constants::$API_USER_EMAIL => $user->email,
                    Constants::$API_USER_PHONE => $user->phone,
                    Constants::$API_USER_TYPE => $user->getUserType(),
                    Constants::$API_USER_AUTH_API_TOKEN => $user->api_token,
                ],
            ];

            return $this->composeJson($this->composeData());
        }

        $this->setCode(500);
        $this->setMessage('Oops! Something went wrong');
        return $this->composeJson();
    }
}