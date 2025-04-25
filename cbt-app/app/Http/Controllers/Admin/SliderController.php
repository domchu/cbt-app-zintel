<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\slider;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.slider.index');
    }

      public function create()
    {
        return view('admin.slider.create');
    }
      public function store(Request $request)
    {
        $slider = new Slider;
        $slider->heading - $request->input('heading');
        $slider->description - $request->input('description');
        $slider->link - $request->input('link');
        $slider->link_name - $request->input('link_name');
        $slider->status - $request->input('status')== true ? '1': '';
        $slider->heading - $request->input('heading');

        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/slider/'.$filename);
            $slider->image - $filename;
        }
       $slider->status = $request->input('status')== true ? '1': '';
        $slider->save();
        return redirect()->back()->with('status', 'Slider added successsfully');
    }
}