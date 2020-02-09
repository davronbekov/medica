<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 09-Feb-20
 * Time: 2:19 PM
 */

namespace App\Core\Models;

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
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relationUsers(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}