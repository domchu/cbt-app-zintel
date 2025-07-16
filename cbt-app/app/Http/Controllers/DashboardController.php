<?php

namespace App\Http\Controllers;

use App\Models\Exams;
use App\Models\User;
use App\Models\Subject;
use App\Models\Questions;
// use Illuminate\Support\Carbon;
// use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{


    public function index()
    {
        $user = auth()->user();
    
        if ($user->role == 1) {
            $adminData = [
                'totalStudents'     => User::where('role', 2)->count(),
                'totalUsers'        => User::where('role', '!=', 1)->count(),
                'totalQuestions'    => Exams::sum('total'),
                'totalSubjects'     => Subject::count(),
                'totalExamQuestions'=> Questions::count(),
                'questionsAnswered' => Exams::sum('total'),
                'correctAnswers'    => Exams::sum('score'),
                'failedAnswers'     => Exams::sum('total') - Exams::sum('score'),
            ];
    
            return view('admin.admin-dashboard', compact('adminData'));
        }
    
        if ($user->role == 2) {
            $userData = [
                'totalStudents'     => User::where('role', 2)->count(),
                'totalUsers'        => User::where('role', '!=', 1)->count(),
                'totalQuestions'    => Exams::sum('total'),
                'totalSubjects'     => Subject::count(),
                'totalExamQuestions'=> Questions::count(),
                'questionsAnswered' => Exams::sum('total'),
                'correctAnswers'    => Exams::sum('score'),
                'failedAnswers'     => Exams::sum('total') - Exams::sum('score'),
            ];
    
            return view('admin.dashboard', compact('userData'));
        }
    
        // In case role is not 1 or 2
        abort(403, 'Unauthorized');
    }
}
    
    
    
    // public function index()
    // {
    //         $totalStudent = User::where('role', 2)->count();
    //         $totalAdmin = User::where('role', 1)->count();
    //         $totalUsers     = User::where('role', '!=', 1)->count();
    //         $totalQuestions     = Exams::sum('total');
    //         $totalSubjects      = Subject::count();
    //         $totalExamQuestions = Questions::count();
    //         $questionsAnswered  = Exams::sum('total');
    //         $correctAnswers     = Exams::sum('score');
    //         $failedAnswers      = Exams::sum('total') - Exams::sum('score');
    //         $monthDate      =        Carbon::now()->format('m');
    //         $MonthlyExam      = Exams::whereDate('created_at', $monthDate)->count();
        

    //     return view('admin-dashboard', compact('totalStudent', 'totalAdmin', 'totalUsers', 'totalQuestions', 'totalExamQuestions', 'questionsAnswered', 'correctAnswers', 'failedAnswers', 'MonthlyExam')); 
    // }

    
        
        
    
}