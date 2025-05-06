<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    //
     protected $table = 'sliders';
    protected $fillable = [
        'heading',
        'description',
        'link',
        'link_name',
        'image',
        'status',
    ];
}