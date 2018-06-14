<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PassengersDebts extends Model
{
    /**
     * Get passenger assigned to debt
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function passenger()
    {
        return $this->belongsTo('App\Passenger', 'passenger_id', 'passenger_id');
    }
}
