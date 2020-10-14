<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Fuel extends Model
{
    use SoftDeletes, Sluggable, SluggableScopeHelpers;
    protected $primaryKey = 'fuel_id';


    /**
     * Get last full fueling for car
     *
     * @param  $query
     * @param  $car
     * @return mixed
     */
    public function scopeLastFullFueling($query, $car)
    {
        return $query   ->where('isFullFueling', '=', '1')
            ->where('car_id', '=', $car)
            ->latest()
            ->first();
    }

    /**
     * Get full fueling assigned to (not full) fueling
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fullFueling()
    {
        return $this->belongsTo(Fuel::class, 'lastFullFueling', 'fuel_id');
    }

    /**
     * Get not full fuelings assigned to this (full) fueling
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notFullFuelings()
    {
        return $this->hasMany(Fuel::class, 'lastFullFueling', 'fuel_id');
    }

    /**
     * Get user assigned to fueling
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App/User', 'user_id', 'user_id');
    }

    /**
     * Get car assigned to fueling
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car()
    {
        return $this->belongsTo('App\Car', 'car_id', 'car_id');
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
                'source' => ['car_id', 'fuelQuantity'],
                'separator' => '-'
            ]
        ];
    }
}
