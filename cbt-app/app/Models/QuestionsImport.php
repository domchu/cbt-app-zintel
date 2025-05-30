<?php


namespace App\Imports;

use App\Models\Questions;
use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        
        $subject = Subject::where('name', $row['subject'])->first();

        if (!$subject) {
            return null;
        }

        return new Questions([
            'subject_id'      => $subject?->id ?? null,
            'subject'         => $row['subject'],
            'year'            => $row['year'],
            'exam_type'       => $row['exam_type'],
            'question'        => $row['question'],
            'option_a'        => $row['option_a'],
            'option_b'        => $row['option_b'],
            'option_c'        => $row['option_c'],
            'option_d'        => $row['option_d'],
            'option_e'        => $row['option_e'],
            'correct_answer'  => $row['correct_answer'],
        ]);
    }
}