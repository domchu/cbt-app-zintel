<?php

namespace App\Models;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class QuestionsImport extends Model
{
  public function import(Request $request){
    Excel::import(new QuestionsImport, $request->file('file'));

    return back()->with('sucess', 'Questions Imported Successfully');
  }
}