<?php

namespace App\Http\Controllers;

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

    public function import(Request $request){
        $request->validate([
           'file'=> 'require|mimes:xlsx,csv',
        ]);
         Excel::import(new QuestionsImport, $request->file('file'));

          return redirect()->back()->with('sucess', 'Questions Imported Successfully');
    }
    
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(questions $questions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(questions $questions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, questions $questions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(questions $questions)
    {
        //
    }
}
