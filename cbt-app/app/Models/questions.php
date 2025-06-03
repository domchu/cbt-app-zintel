<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $table = 'questions';

    protected $fillable = [
'subject_id', 
'subject',
'year',
'exam_type', 
'question', 
'option_a', 
'option_b', 
'option_c', 
'option_d', 
'option_e', 
'correct_answer'

];
public function subject(){
    return $this->belongsTo(Subject::class);
}
}