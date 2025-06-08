<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    public function examHistory()
{
    $results = ExamResult::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();

    return view('exam.history', compact('results'));
}
}