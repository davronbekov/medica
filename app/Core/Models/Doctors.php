<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 09-Feb-20
 * Time: 12:57 PM
 */

namespace App\Core\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Doctors
 * @package App\Core\Models
 * @property int $id
 * @property int $hospital_id
 * @property int $user_id
 * @property String $job
 * @property String $about
 *
 * @property-read User $relationUsers
 * @property-read Doctor_reviews $relationReviews
 */
class Doctors extends Model
{
    protected $table = 'doctors';
    public $timestamps = false;

    public function getItem($id = null){
        $item = parent::query();
        $item = $item
            ->where('user_id', '=', $id)
            ->first();

        return $item;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relationUsers(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function relationReviews(){
        return $this->hasMany(Doctor_reviews::class, 'doctor_id', 'user_id');
    }
}