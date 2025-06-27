<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\Questions;
use App\Models\ExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
  
   
    public function index()
    {
        $user = Auth::user();
    
        // Initialize both variables to prevent "undefined variable" error
        $userData = [];
        $adminData = [];
        // dd(Auth::user()->role);
        if ($user->role == 1) {
            // Admin stats
            $adminData = [
                'totalStudents'     => User::where('role', 2)->count(),
                'totalUsers'        => User::where('role', '!=', 1)->count(),
                'totalQuestions'    => Questions::count(),
                'totalSubjects'     => Subject::count(),
                'questionsAnswered' => ExamResult::sum('answered'),
                'correctAnswers'    => ExamResult::sum('score'),
                'failedAnswers'     => ExamResult::sum('total') - ExamResult::sum('score'),
            ];
        } elseif ($user->role == 2) {
            // Student stats
            $results = ExamResult::where('user_id', $user->id);
    
            $userData = [
                'totalSubjects'      => Subject::count(),
                'totalQuestions'     => Questions::count(),
                'answeredQuestions'  => $results->sum('answered'),
                'correctAnswers'     => $results->sum('score'),
                'failedAnswers'      => $results->sum('total') - $results->sum('score'),
            ];
        }
    
        // Line chart data
        $performanceOverTime = ExamResult::selectRaw('DATE(created_at) as date, AVG(score / total * 100) as avg_score')
        ->where('total', '>', 0) // avoid division by zero
        ->groupBy('date')
        ->orderBy('date')
        ->get();
    
        // Prepare data for chart.js
      // Extract dates and scores for Chart.js
$performanceDates = $performanceOverTime->pluck('date')->toArray();
$performanceScores = $performanceOverTime->pluck('avg_score')->map(fn($s) => round($s, 2))->toArray();

    
        return view('dashboard', compact(
            'userData',
            'adminData',
            'performanceOverTime',
            'performanceDates',
            'performanceScores'
        ));
    }
    

}