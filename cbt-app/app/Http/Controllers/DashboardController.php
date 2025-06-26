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
             // Admin stats
        if ($user->is_admin) {
                $adminData = [
                'totalStudent' => User::where('role', 'role')->count(),
                'totalUsers' => User::where('is_admin', false)->count(),
                'totalQuestions' => Questions::count(),
                'totalSubjects' => Subject::count(),
                'questionsAnswered' => ExamResult::count(),
                'correctAnswers' => ExamResult::where('is_correct', true)->count(),
                'failedAnswers' => ExamResult::sum('failed'),
    
                 ];
        }
        else {
                // Student stats
                $result = ExamResult::where('user_id', $user->id);
                $userData = [
                'totalSubjects' => Subject::count(),
                'totalQuestions' => Questions::count(),
                'answeredQuestions' => $result->sum('answered'),
                'correctAnswers' => $result->sum('correct'),
                'failedAnswers' => $result->sum('failed'),
                ];
        }

    // For line chart - group by date
        $performanceOverTime = ExamResult::selectRaw('DATE(created_at) as date, AVG(score / total * 100) as avg_score')
        ->groupBy('date')
        ->orderBy('date')
        ->get();

        return view('dashboard', compact(
            'UserData', 
            'adminData',   
                        'performanceOverTime'
 
       
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