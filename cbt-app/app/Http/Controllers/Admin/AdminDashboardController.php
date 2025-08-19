<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Exams;
use App\Models\Subject;
use App\Models\Questions;
// use App\Models\Answer;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Only allow admin
        if ($user->role != 1) {
            abort(403, 'Unauthorized');
        }

        // Global stats
        $totalUsers = User::count();
        $totalStudents = User::where('role', 2)->count(); // student role = 2
        $totalSubjects = Subject::count();
        $totalQuestions = Questions::count();
        $answeredQuestions = Exams::count();
        $totalQuestions = Exams::sum('total');
         $correctAnswers = Exams::where('user_id', $user->id)->sum('score');
        $totalQuestions = Exams::where('user_id', $user->id)->sum('total');
        $failedAnswers  = $totalQuestions - $correctAnswers;

        // Exam history
        $examHistory = Exams::with(['student', 'subject'])->latest()->get();
        

        // Answers stats
        
        // $correctAnswers = Exams::where('is_correct', true)->count();
        // $failedAnswers = Exams::where('is_correct', false)->count();

        return view('admin.admin-dashboard', compact(
            'totalUsers',
            'totalStudents',
            'totalSubjects',
            'totalQuestions',
            'answeredQuestions',
            'correctAnswers',
            'failedAnswers',
            'examHistory'
        ));
    }
}