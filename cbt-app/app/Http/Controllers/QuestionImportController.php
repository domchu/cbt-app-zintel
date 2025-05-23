<?php

namespace App\Http\Controllers;

use App\Models\QuestionsImport;
use App\Models\Subject;
use App\Models\questions;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;


class QuestionImportController extends Controller
{
    public function showUploadForm()
    {
        return view('admin.questions.upload');
    }

    public function preview(Request $request){
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $import = new QuestionsImport();
        Excel::import($import, $request->file('file'));

        $rows = $import->rows;

        if (count($rows) < 2) {
            return redirect()->back()->withErrors(['file' => 'The uploaded file is empty or invalid']);
        }

        $headers = array_map('strtolower', $rows[0]->toArray());
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
            $questions[] = array_combine($headers, $row->toArray());
        }

        return view('questions.preview', compact('questions'));
    }

    }
    
    // IMPORT COMFIRMED QUESTIONS

    public function importConfirmed(Request $request)
    {
        foreach ($request->questions as $question) {
            $subject = Subject::where('name', $question['subject'])->first();
            if(!$subject){
                continue;
            }
            Questions::create([
                'subject_id'=> $subject->id,
                'subject'=> $question['subject'],
                'year'=> $question['year'],
                'exam_type'=> $question['exam_type'],
                'question'=> $question['question'],
                'option_a'=> $question['option_a'],
                'option_b'=> $question['option_b'],
                'option_c'=> $question['option_c'],
                'option_d'=> $question['option_d'],
                'option_e'=> $question['option_e'],
                'correct_answer'=> $question['correct_answer'],

            ]);
        }
        return redirect()->route('questions.upload')->with('success', 'Questions Uploaded Successfully');
    }
    
    
    // public function index()
    // {
    
    // }

    
    // public function create()
    // {
        
    // }

    //     public function store(Request $request)
    // {
        
    // }

    
    public function show(questions $questions)
    {
        return view('admin.questions.view', compact('questions'));
    }

   
    // public function edit(questions $questions)
    // {
        
    // }

    
    // public function update(Request $request, questions $questions)
    // {
        
    // }

   
    // public function destroy(questions $questions)
    // {
        
    // }
}