<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    protected $table = 'exams';
    use HasFactory;

    protected $fillable = [
'user_id',
'subject_id',
'exam_type',
'year',
'score',
'status',
'user_answers'
    ];
    protected $casts = [
        'user_answers' => 'array',
    ];
    public function user(){
        return $this->belongsTo(User::class);
        
    }
    public function subject(){
        return $this->belongsTo(Subject::class);

    }
}
