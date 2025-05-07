<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
     protected $table = 'sliders';
    protected $fillable = [
        'surname',
        'first_name',
        'other_name',
        'email',
        'password',
        'phone',
        'gender',
        'state',
        'country',
        'registration_number',
        'address',
        'dob',
        'role',
        'image',
        'status',
    ];
    protected $hidden = ['password'];
}