<?php

namespace App\Models;

use App\Models\Subject;
use App\Models\Questions;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\withHeadingRow;
use Maatwebsite\Excel\Collections\RowCollection;

class QuestionsImport implements ToModel, withHeadingRow
{
  public function Model(array $row)
      {
           $subject = Subject::where('name', $row['subject'])->first();
            if(!$subject){
            return null;
            }

      return new Questions([
      'year'=> $row['year'],
      'subject_id'=> $subject->id,
      'question'=> $row['question'],
      'exam_type'=> $row['exam_type'],
      'option_b'=> $row['option_b'],
      'option_a'=> $row['option_a'],
      'option_d'=> $row['option_d'],
      'option_c'=> $row['option_c'],
      'option_e'=> $row['option_e'],
      'correct_answer'=> $row['correct_answer'],

     ]);
      
   
    }
}