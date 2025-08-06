<?php

namespace App\Models;
// use App\Models\ExamResult;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $table = 'exams';
    use HasFactory;

    protected $fillable = [
            'user_id',
            'subject_id',
            'subject',
            'name',
            'exam_type',
            'year',
            'score',
            'total',
           

                ];
    protected $casts = [
        'user_answers' => 'array',
    ];
    public function user(){
        return $this->belongsTo(User::class);
        
    }
    public function subject(){
        // return $this->belongsTo(Subject::class);
        return $this->belongsTo(Subject::class, 'subject_id');


    }
}