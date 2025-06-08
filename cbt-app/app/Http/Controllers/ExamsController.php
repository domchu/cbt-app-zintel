<?php

namespace App\Http\Controllers;


use App\Models\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ExamResult;

class ExamsController extends Controller
{
    
    public function index()
{
    return view('exam.index');
}
    // SELECT YEAR/SUBJECT/EXAMTYPE
    public function showExamForm()
{

    $subjects = Questions::select('subject')->distinct()->pluck('subject');
    $years = Questions::select('year')->distinct()->pluck('year');
    $examTypes = Questions::select('exam_type')->distinct()->pluck('exam_type');

    return view('exam.index', compact('subjects', 'years', 'examTypes'));
}

// START EXAMINATION
public function startExam(Request $request)
{
    $validated = $request->validate([
        'subject' => 'required|string',
        'year' => 'required|numeric',
        'exam_type' => 'required|string',
    ]);

    // Find matching questions
    $questions = Questions::where('subject', $validated['subject'])
        ->where('year', $validated['year'])
        ->where('exam_type', $validated['exam_type'])
        ->inRandomOrder()
        ->get();

    if ($questions->isEmpty()) {
        return back()->with('error', 'No questions found for selected criteria.');
    }

    return view('exam.start', [
        'questions' => $questions,
        'subject' => $validated['subject'],
        'year' => $validated['year'],
        'exam_type' => $validated['exam_type'],
    ]);
}



public function submitExam(Request $request)
{
    $answers = $request->input('answers', []);
    // Save or grade logic goes here

    return redirect()->route('dashboard')->with('success', 'Exam submitted successfully!');
}
public function examHistory()
{
    $user = Auth::user();

    $results = ExamResult::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

    return view('exam.history', compact('results'));
}
public function showResult()
{
    $user = Auth::user();

    // Example: fetch the most recent result
    $latestResult = ExamResult::where('user_id', $user->id)
                    ->latest()
                    ->first();

    if (!$latestResult) {
        return redirect()->route('exam.index')->with('error', 'No exam result found.');
    }

    return view('exam.result', compact('latestResult'));
}
    
    
    
    
}