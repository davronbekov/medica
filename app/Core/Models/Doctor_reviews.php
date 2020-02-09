<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 09-Feb-20
 * Time: 2:19 PM
 */

namespace App\Core\Models;

use Exception;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Doctor_reviews
 * @package App\Core\Models
 * @property int $id
 * @property int $doctor_id
 * @property int $user_id
 * @property int $mark
 * @property String $comments
 *
 * @property-read User $relationUsers
 */
class Doctor_reviews extends Model
{
    protected $table = 'doctor_reviews';

    /**
     * @param array $data
     * @return bool
     */
    public function insertItem($data = []){
        try{
            $this->doctor_id = $data['doctor_id'];
            $this->user_id = $data['user_id'];
            $this->mark = $data['mark'];
            $this->comments = $data['comments'];
            $this->save();
            return true;
        }catch(Exception $exception){
            return false;
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relationUsers(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}