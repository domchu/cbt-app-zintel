<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Questions;
use Illuminate\Http\Request;
use App\Imports\QuestionsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QuestionsPreviewImport;
use Illuminate\Support\Facades\Validator;

class QuestionImportController extends Controller
{
    public function showUploadForm()
    {
        return view('admin.questions.upload');
    }

    public function preview(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (!$request->hasFile('file')) {
            return redirect()->back()->withErrors(['file' => 'Missing file for import.']);
        }

        $import = new QuestionsPreviewImport();
        Excel::import($import, $request->file('file'));

        $rows = $import->rows ?? collect();

        if  (count($rows) < 2) {
            return redirect()->back()->withErrors(['file' => 'The uploaded file is empty or invalid']);
        }

        $firstRow = $rows->first();
        $headers = array_map('strtolower', array_keys($firstRow->toArray()));
        $requiredHeaders = [
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

        if (array_diff($requiredHeaders, $headers)) {
            return redirect()->back()->withErrors(['file' => 'Invalid file format. Ensure correct column headers.']);
        }

        $questions = [];
      
        foreach ($rows->slice(1) as $row) {
            $rowData = array_combine($headers, array_values($row->toArray()));
            $subject = Subject::where('name', $rowData['subject'])->first();

            $questions[] = [
                'subject_id' => $rowData['subject_id'],
                'subject' => $rowData['subject'],
                'year' => $rowData['year'],
                'exam_type' => $rowData['exam_type'],
                'question' => $rowData['question'],
                'option_a' => $rowData['option_a'],
                'option_b' => $rowData['option_b'],
                'option_c' => $rowData['option_c'],
                'option_d' => $rowData['option_d'],
                'option_e' => $rowData['option_e'],
                'correct_answer' => $rowData['correct_answer'],
            ];
        }

        return view('admin.questions.preview', compact('questions'));
    }

    public function importConfirmed(Request $request)
    {
        $questions = $request->input('questions', []);

    if (!is_array($questions) || empty($questions)) {
        return redirect()->route('questions.upload')->withErrors(['file' => 'No questions data found for import.']);
    }

    
    foreach ($questions as $questionData) {

        $cleanData = [];
        foreach ($questionData as $key => $value) {
            $cleanKey = trim($key, "'");
            $cleanData[$cleanKey] = $value;
        }
        Questions::create([
            'subject_id'     => $cleanData['subject_id'] ?? null,
            'subject'        => $questionData['subject'] ?? '',
           'year' => isset($cleanData['year']) && is_numeric($cleanData['year']) ? (int) $cleanData['year'] : null,
            'exam_type'      => $cleanData['exam_type'] ?? '',
            'question'       => $cleanData['question'] ?? '',
            'option_a'       => $cleanData['option_a'] ?? '',
            'option_b'       => $cleanData['option_b'] ?? '',
            'option_c'       => $cleanData['option_c'] ?? '',
            'option_d'       => $cleanData['option_d'] ?? '',
            'option_e'       => $cleanData['option_e'] ?? '',
            'correct_answer' => $cleanData['correct_answer'] ?? '',
        ]);
    }
        return redirect()->route('questions.upload')->with('success', 'Questions Imported Successfully');
    }

    public function show(Questions $questions)
    {
        return view('admin.questions.view', compact('questions'));
    }
}