<?php

namespace App\Http\Controllers;

use App\Models\Exams;
use App\Models\User;
use App\Models\Subject;
use App\Models\Questions;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{


    // public function index()
    // {
    //     $user = Auth::user();
    
    //     // Admin Dashboard
    //     if ($user->role == 1) {
    //         $adminData = [
    //             'totalStudents'     => User::where('role', 2)->count(),
    //             'totalUsers'        => User::where('role', '!=', 1)->count(),
    //             'totalQuestions'    => Exams::sum('total'),
    //             'totalSubjects'     => Subject::count(),
    //             'totalExamQuestions' => Questions::count(),
    //             'questionsAnswered' => Exams::sum('total'),
    //             'correctAnswers'    => Exams::sum('score'),
    //             'failedAnswers'     => Exams::sum('total') - Exams::sum('score'),
    //         ];
    
    //         return view('admin.dashboard', compact('adminData')); // 👈 admin view
    //     }
    
    //     // Student/User Dashboard
    //     $userExams = Exams::where('user_id', $user->id);
    
    //     $userData = [
    //         'totalSubjects'     => Subject::count(),
    //         'totalQuestions'    => $userExams->sum('total'),
    //         'answeredQuestions' => $userExams->sum('total'),
    //         'correctAnswers'    => $userExams->sum('score'),
    //         'failedAnswers'     => $userExams->sum('total') - $userExams->sum('score'),
    //     ];
    
    //     return view('user.dashboard', compact('userData')); // 👈 user view
    // }
    
    public function admin()
    {
        $adminData = [
            'totalStudents'      => User::where('role', 2)->count(),
            'totalUsers'         => User::where('role', '!=', 1)->count(),
            'totalQuestions'     => Exams::sum('total'),
            'totalSubjects'      => Subject::count(),
            'totalExamQuestions' => Questions::count(),
            'questionsAnswered'  => Exams::sum('total'),
            'correctAnswers'     => Exams::sum('score'),
            'failedAnswers'      => Exams::sum('total') - Exams::sum('score'),
        ];

        return view('admin.admin-dashboard', compact('adminData')); // ✅ Admin view
    }

    public function user()
    {
        $user = Auth::user();

        $userExams = Exams::where('user_id', $user->id);

        $userData = [
            'totalSubjects'     => Subject::count(),
            'totalQuestions'    => $userExams->sum('total'),
            'answeredQuestions' => $userExams->sum('total'),
            'correctAnswers'    => $userExams->sum('score'),
            'failedAnswers'     => $userExams->sum('total') - $userExams->sum('score'),
        ];

        return view('admin.dashboard', compact('userData')); // ✅ Student view
    }
}