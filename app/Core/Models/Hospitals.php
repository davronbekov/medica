<?php
/**
 * Created by Netco Telecom.
 * User: Otabek
 * Date: 09-Feb-20
 * Time: 12:54 PM
 */

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hospitals
 * @package App\Core\Models
 * @property int $id
 * @property String $name
 * @property String $address
 * @property String $keywords
 *
 * @property-read Doctors $relationDoctors
 */
class Hospitals extends Model
{
    protected $table = 'hospitals';
    public $timestamps = false;

    public $total_items = 18;

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder
     */
    public function getItems(){
        $items = parent::query();

        $items = $items
            ->orderBy('name', 'asc')
            ->paginate($this->total_items);

        return $items;
    }

    /**
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Builder|Model|object|null
     */
    public function getItem($id = null){
        $item = parent::query();
        $item = $item
            ->where('id', '=', $id)
            ->first();

        return $item;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relationDoctors(){
        return $this->belongsTo(Doctors::class, 'id', 'hospital_id');
    }
}