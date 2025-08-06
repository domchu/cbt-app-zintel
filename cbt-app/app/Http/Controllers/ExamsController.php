<?php

namespace App\Http\Controllers;


use App\Models\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ExamResult;
use App\Models\Subject;


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


    $subjectModel = Subject::where('name', $validated['subject'])->first();

    if (!$subjectModel) {
        return back()->with('error', 'Subject not found in database.');
    }
    return view('exam.start', [
        'questions' => $questions,
        'subject' => $validated['subject'],
        'year' => $validated['year'],
        'exam_type' => $validated['exam_type'],
        'subject_id' => $subjectModel->id,
    ]);
}
// dd($questions->first())

// SUBMIT EXAMINATION QUESTIONS
public function submitExam(Request $request)
{
    
    $user = Auth::user();
    $answers = $request->input('answers', []);
    $subject = $request->input('subject');
    $year = $request->input('year');
    $exam_type = $request->input('exam_type');

    $questions = Questions::where('subject', $subject)
                ->where('year', $year)
                ->where('exam_type', $exam_type)
                ->get();

    $score = 0;
    $total = $questions->count();

    foreach ($questions as $question) {
        if (isset($answers[$question->id]) && $answers[$question->id] == $question->correct_answer) {
            $score++;
        }
    }
    // dd($request->all());

    // Save result
    $result = ExamResult::create([
        'user_id' => $user->id,
        'subject_id' => $request->input('subject_id'),
        'subject' => $subject,
        'name' => $user->name,
        'year' => $year,
        'exam_type' => $exam_type,
        'score' => $score,
        'total' => $total,
    ]);

    return redirect()->route('exam.result')->with('success', 'Exam submitted successfully!');
}

// EXAMINATION HISTORY
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