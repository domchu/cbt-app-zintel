<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $table = "subjects";
    protected $fillable = [
        "subject",
        "code",
        "status"
    ];


    protected $casts = [
        'status' => 'boolean',
    ];


    public function questions(){
        return $this->HasMany(Questions::class);
    }
}