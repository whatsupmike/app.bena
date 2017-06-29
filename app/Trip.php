<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Trip extends Model
{
    use SoftDeletes, Sluggable, SluggableScopeHelpers;
    protected $primaryKey = 'trip_id';


    /**
     * Get fueling assigned to trip
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fueling()
    {
        return $this->belongsTo('App\Fuel', 'fuel_id', 'fuel_id');
    }
    

    /**
     * Get car assigned to trip
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car(){
        return $this->belongsTo('App\Car', 'car_id', 'car_id');
    }

    /**
     * Get user assigned to trip
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ['odometerBefore', 'car_id'],
                'separator' => '-'
            ]
        ];
    }
}
