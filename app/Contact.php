<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Contact extends Model
{
    use Notifiable;

    // protected $fillable = [
    //     'name',
    //     'position',
    //     'phone',
    //     'image'
    // ];

    protected $guarded = [];
}
