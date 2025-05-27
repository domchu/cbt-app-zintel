<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\QuestionsImport;
use App\Imports\QuestionsPreviewImport;
use App\Models\Questions;
use Maatwebsite\Excel\Facades\Excel;
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

        $import = new QuestionsPreviewImport();
        Excel::import($import, $request->file('file'));

        $rows = $import->rows ?? collect();

        if ($rows->count() < 1) {
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
            $questions[] = array_combine($headers, array_values($row->toArray()));
        }

        return view('admin.questions.preview', compact('questions'));
    }

    public function importConfirmed(Request $request)
    {
        if (!$request->has('file_path')) {
            return redirect()->route('questions.upload')->withErrors(['file' => 'Missing file for import']);
        }

        Excel::import(new QuestionsImport, $request->file('file_path'));

        return redirect()->route('questions.upload')->with('success', 'Questions Imported Successfully');
    }

    public function show(Questions $questions)
    {
        return view('admin.questions.view', compact('questions'));
    }
}