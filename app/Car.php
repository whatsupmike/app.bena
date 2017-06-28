<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Cviebrock\EloquentSluggable\Sluggable;
    use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

    class Car extends Model
    {
        use SoftDeletes, Sluggable, SluggableScopeHelpers;
        protected $primaryKey = 'car_id';

        /**
         * Get trips assigned to car
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function trips()
        {
            return $this->hasMany('App\Trip', 'car_id', 'car_id');
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
                    'source' => 'name'
                ]
            ];
        }

    }
