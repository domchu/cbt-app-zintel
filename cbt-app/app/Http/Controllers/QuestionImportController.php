<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\questions;
use Illuminate\Http\Request;
// use App\Models\QuestionsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class QuestionImportController extends Controller
{
    public function showUploadForm()
    {
        return view('admin.questions.upload');
    }

    public function preview(Request $request){

        $validator = Validator::make($request->all(), [
            'file' => 'require|mimes:xlsx,xls,csv',
        ]);
        

        $path = $request->file('file')->getRealPath();
        $data =Excel::toArray([], $request->file('file'))[0];

        if(count($data) < 2){
            return redirect()->back()->withErrors(['file' => 'The uploaded file is empty or invalid']);
        }
        $hearders = array_map('strtolower', $data[0]);
        $requiredHeaders = [
            'subject_id',
            "subject",
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
                'subject'=> $question['subject'],
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