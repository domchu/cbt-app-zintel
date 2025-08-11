<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Exams;
use App\Models\Subject;
use App\Models\Questions;
use App\Models\ExamResult;



class DashboardController extends Controller
{


    public function index()
    {
        $user = auth()->user();
        $results = Exams::where('user_id', $user->id)->get();
        $correctAnswers = Exams::where('user_id', $user->id)->sum('score');
        $totalQuestions = Exams::where('user_id', $user->id)->sum('total');
        $failedAnswers  = $totalQuestions - $correctAnswers;

        if ($user->role == 1) {
            $adminData = [
                'totalStudents'     => User::where('role', 2)->count(),
                'totalUsers'        => User::where('role', '!=', 1)->count(),
                'totalQuestions'    => Exams::sum('total'),
                'totalSubjects'     => Subject::count(),
                'correctAnswers'     => $correctAnswers,
                'failedAnswers'      => $failedAnswers,
                'answeredQuestions'  => $correctAnswers + $failedAnswers,
            ];

            return view('admin.admin-dashboard', compact('adminData'));
        }
    

        // USER/STUDENT DASHBOARD
        if ($user->role == 2) {
               // 👇 Fetch the exam history for the logged-in user
               // Get ALL exam results for the current user
                   $results = Exams::where('user_id', $user->id)
                    ->orderByDesc('created_at')
                    ->get();
            // Optional: If you still want to show latest separately
            $latestResult = $results->first();
// COUNT FOR DASHBOARD
            $userData = [
                'totalStudents'     => User::where('role', 2)->count(),
                'totalUsers'        => User::where('role', '!=', 1)->count(),
                'totalQuestions'    => Exams::sum('total'),
                'totalSubjects'     => Subject::count(),
                'totalExamQuestions'=> Questions::count(),
                'correctAnswers'     => $correctAnswers,
                'failedAnswers'      => $failedAnswers,
                'answeredQuestions'  => $correctAnswers + $failedAnswers,
            ];

            // CHARTS
         $subjects = $results->pluck('subject')->toArray();
          $scores = $results->pluck('score')->toArray();

    // SUBJECT & PERCENTAGE CHART
// For bar chart, if multiple exams per subject, pick latest exam per subject
$latestScoresPerSubject = $results
    ->sortByDesc('created_at')
    ->groupBy('subject')
    ->map(function($exams) {
        return $exams->first(); // latest exam per subject
    });

$barSubjects = $latestScoresPerSubject->pluck('subject')->toArray();
$barScores = $latestScoresPerSubject->pluck('score')->toArray();

// Prepare pie chart data (subject vs average percentage)
$groupedBySubject = $results->groupBy('subject');

$pieSubjects = [];
$piePercentages = [];

foreach ($groupedBySubject as $subject => $exams) {
    $totalPercentage = 0;
    $count = 0;

    foreach ($exams as $exam) {
        if ($exam->total > 0) {
            $totalPercentage += ($exam->score / $exam->total) * 100;
            $count++;
        }
    }

    if ($count > 0) {
        $pieSubjects[] = $subject;
        $piePercentages[] = round($totalPercentage / $count, 2);
    }
}

// barchart
$results = Exams::where('user_id', $user->id)
    ->orderBy('created_at', 'asc')
    ->get();




            return view('admin.dashboard', 
            compact(
            'userData',
            'results',
                'scores', 
                'subjects', 
                'barSubjects', 
                'barScores', 
                'pieSubjects', 
                'piePercentages',
                 'latestResult'));
        }
    
        // In case role is not 1 or 2
        abort(403, 'Unauthorized');
    }

    // HISTORY LOGIC
    public function history()
{
    $results = ExamResult::orderBy('created_at', 'desc')->get();
    return view('admin.history', compact('results'));
}
    
   
    
        
        
    
}