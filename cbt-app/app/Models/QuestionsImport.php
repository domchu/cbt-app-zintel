<?php

namespace App\Models;

use App\Models\Subject;
use App\Models\Questions;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class QuestionsImport implements ToModel, WithHeadingRow
{

  public $rows;

  public function collection(Collection $collection)
  {
      $this->rows = $collection;
  }
  public function model(array $row)
      {
           $subject = Subject::where('name', $row['subject'])->first();
            if(!$subject){
            return null;
            }

      return new Questions([
      'subject_id'=> $subject->id,
      'subject'=> $row['subject'],
      'year'=> $row['year'],
      'exam_type'=> $row['exam_type'],
      'question'=> $row['question'],
      'option_a'=> $row['option_a'],
      'option_b'=> $row['option_b'],
      'option_c'=> $row['option_c'],
      'option_d'=> $row['option_d'],
      'option_e'=> $row['option_e'],
      'correct_answer'=> $row['correct_answer'],
     ]);
      
   
    }
}