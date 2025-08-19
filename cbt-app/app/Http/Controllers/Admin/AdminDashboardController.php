<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Exams;
use App\Models\Subject;
use App\Models\Questions;

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
        $totalStudents = User::where('role', 2)->count();
        $totalSubjects = Subject::count();
        $totalQuestions = Questions::count();

 // Answer stats
        $answeredQuestions = Exams::sum('total');
        $correctAnswers = Exams::sum('score');
        $failedAnswers = $answeredQuestions - $correctAnswers;

        // Exam history
        $examHistory = Exams::with(['student', 'subject'])->latest()->get();

$chartData = [
    'labels' => ['Correct Answers', 'Failed Answers'],
    'data'   => [$correctAnswers, $failedAnswers],
];

      $adminData = [
    'totalStudents' => $totalStudents,
    'totalUsers' => $totalUsers,
    'totalQuestions' => $totalQuestions,
    'totalSubjects' => $totalSubjects,
    'correctAnswers' => $correctAnswers,
    'failedAnswers' => $failedAnswers,
    'answeredQuestions' => $answeredQuestions,
];

        

        return view('admin.admin-dashboard', compact(
            'adminData',
            'examHistory',
             'chartData'
        ));
    }
}