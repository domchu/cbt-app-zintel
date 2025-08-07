<?php

namespace App\Http\Controllers;

use App\Models\Exams;
use App\Models\User;
use App\Models\Subject;
use App\Models\Questions;



class DashboardController extends Controller
{


    public function index()
    {
        $user = auth()->user();
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
    
            return view('admin.dashboard', compact('userData', 'results','latestResult'));
        }
    
        // In case role is not 1 or 2
        abort(403, 'Unauthorized');
    }

    
    
    
   
    
        
        
    
}