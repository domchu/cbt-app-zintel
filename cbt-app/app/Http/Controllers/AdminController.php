<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exams;
use App\Models\Subject;

class AdminController extends Controller
{
    // Example: Admin dashboard
    public function dashboard()
    {
        $totalStudents = User::where('role', 2)->count();
        $totalSubjects = Subject::count();
        $totalExams    = Exams::count();

        return view('admin.dashboard', compact('totalStudents', 'totalSubjects', 'totalExams'));
    }

    // Example: Fetch all students with results
    public function allStudentResults(Request $request)
    {
        $query = Exams::query();

        if ($request->filled('subject')) {
            $query->where('subject', $request->subject);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $results = $query->orderBy('created_at', 'desc')->paginate(20);
        $subjects = Subject::distinct()->pluck('name');
        $years = Exams::select('year')->distinct()->pluck('year');

        return view('admin.exam-results', compact('results', 'subjects', 'years'));
    }
}
