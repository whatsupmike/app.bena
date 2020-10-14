<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Collective\Html\FormFacade as Form;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Form macros

        Form::macro(
            'select_with_data',
            function ($name, $values_with_data, $selected = null, $attributes_list = []) {
                $attributes = '';
                foreach ($attributes_list as $attribute => $value) {
                    $attributes .= $attribute.'="'.$value.'" ';
                }

                $options = '';
                foreach ($values_with_data as $value => $text_data) {
                    $data='';
                    foreach ($text_data['data'] as $data_attribute_name => $data_attribute_value) {
                        $data.= 'data-'.$data_attribute_name.'="'.$data_attribute_value.'" ';
                    }

                    if ($value == $selected) {
                        $selected_attribute = "selected";
                    } else {
                        $selected_attribute = "";
                    }

                    $options .='<option value="'.$value.'" '.$data.$selected_attribute.'>'.$text_data['name'].'</option>';
                }


                $select = '<select name="'.$name.'" '.$attributes.'>'.$options.'</select>';

                return $select;
            }
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
