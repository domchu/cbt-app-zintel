<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\questions;
use Illuminate\Http\Request;
use App\Models\QuestionsImport;
use Maatwebsite\Excel\Facades\Excel;

class QuestionImportController extends Controller
{
    public function showUploadForm()
    {
        return view('questions.upload');
    }

    public function preview(Request $request){
        $request->validate([
           'file'=> 'require|mimes:xlsx,csv',
        ]);

        $path = $request->file('file')->getRealPath();
        $data =Excel::toArray([], $request->file('file'))[0];

        if(count($data) < 2){
            return redirect()->back()->withErrors(['file' => 'The uploaded file is empty or invalid']);
        }
        $hearders = array_map('strtolower', $data[0]);
        $requiredHeaders = [
            'subject_id','exam_type','year','question','option_a','option_b','option_c','option_d','option_e','correct_answer'
        ];
        if(array_diff($requiredHeaders, $hearders)){
            return redirect()->back()->withErrors(['file' => ' invalid file format. Ensure correct columns haeders.']); 
        }
        $questions = [];
        foreach (array_slice($data, 1) as  $row) {
            $questions[] = array_combine($hearders, $row);
        }
        return view('questions.preview', compact('questions'));

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
'subject_id'=>$subject->id,
'year'=> $question['year'],
'exam_type'=> $question['exam_type'],
'question'=>$question['question'],
'option_a'=>$question['option_a'],
'option_b'=>$question['option_b'],
'option_c'=>$question['option_c'],
'option_d'=>$question['option_d'],
'option_e'=>$question['option_e'],
'correct_answer'=>$question['correct_answer'],

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

    /**
     * Display the specified resource.
     */
    // public function show(questions $questions)
    // {
    
    // }

   
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