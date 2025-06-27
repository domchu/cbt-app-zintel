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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
    
        // Always define these to avoid undefined variable errors
        $adminData = [];
        $userData = [];
    
        if ($user->role == 1) {
            $adminData = [
                'totalStudents' => User::where('role', 2)->count(),
                'totalUsers' => User::where('role', '!=', 1)->count(),
                'totalQuestions' => Questions::count(),
                'totalSubjects' => Subject::count(),
                'questionsAnswered' => ExamResult::sum('answered'),
                'correctAnswers' => ExamResult::sum('score'),
                'failedAnswers' => ExamResult::sum('total') - ExamResult::sum('score'),
            ];
        
            // $correctAnswers = $adminData['correctAnswers'];
            // $failedAnswers = $adminData['failedAnswers'];
        
            $performance = ExamResult::selectRaw('DATE(created_at) as date, AVG(score / total * 100) as avg_score')
                ->groupBy('date')
                ->orderBy('date')
                ->get();
        } else {
            $results = ExamResult::where('user_id', $user->id);
        
            $userData = [
                'totalSubjects' => Subject::count(),
                'totalQuestions' => Questions::count(),
                'answeredQuestions' => $results->sum('answered'),
                'correctAnswers' => $results->sum('score'),
                'failedAnswers' => $results->sum('total') - $results->sum('score'),
            ];
        
            $correctAnswers = $userData['correctAnswers'];
            $failedAnswers = $userData['failedAnswers'];
        
            $performance = $results->selectRaw('DATE(created_at) as date, AVG(score / total * 100) as avg_score')
                ->groupBy('date')
                ->orderBy('date')
                ->get();
        }
        
        // For chart.js
        $performanceDates = $performance->pluck('date')->toArray();
        $performanceScores = $performance->pluck('avg_score')->toArray();
        
        return view('dashboard', compact(
            'userData',
            'adminData',
            'correctAnswers',
            'failedAnswers',
            'performanceDates',
            'performanceScores'
        ));
        
    }
    



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}