<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {
    /**
     * 
     */
    protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name', 
        'number',
    ];
}
