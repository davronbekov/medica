<?php

namespace App;

use App\Core\Models\Doctors;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Str;

/**
 * Class User
 * @package App
 * @property int $id
 * @property String $name
 * @property String $email
 * @property String $phone
 * @property String $api_token
 * @property String $password
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $email
     * @param $password
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function validateUserAuth($email, $password){
        $item = parent::query();
        $item = $item
            ->where('email', '=', $email)
            ->first();

        if(is_null($item))
            return null;

        if(Hash::check($password, $item->password))
            return $item;

        return null;
    }

    /**
     * @return bool
     */
    public function updateApiToken(){
        try{
            $token = Str::random(60);
            $this->api_token = $token;
            $this->save();
            return true;
        }catch(Exception $exception){
            return false;
        }
    }

    public function getUserType(){
        /**
         * @var Doctors $doctors
         */
        $doctors = app(Doctors::class);
        $doctors = $doctors->getItem($this->id);
        if(is_null($doctors))
            return "client";

        return "doctor";
    }

    /**
     * @return bool
     */
    public function logout(){
        try{
            $this->api_token = null;
            $this->save();
            return true;
        }catch(Exception $exception){
            return false;
        }
    }

    /**
     * @param array $data
     * @return bool
     */
    public function register($data = []){
        try{
            $this->name = $data['name'];
            $this->email = $data['email'];
            $this->phone = $data['phone'];
            $this->password = Hash::make($data['password']);
            return true;
        }catch (Exception $exception){
            return false;
        }
    }
}
