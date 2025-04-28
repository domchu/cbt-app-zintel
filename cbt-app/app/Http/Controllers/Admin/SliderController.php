<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::all();
        return view('admin.slider.index', compact('slider'));
    }
     // CREATE SLIDER
      public function create()
    {
        return view('admin.slider.create');
    }

    // STORE SLIDER
      public function store(Request $request)

    {
        $validator = Validator::make($request->all(),[
                    'heading' => 'required|string|max:225',
                    'description' => 'required',
                    'link'=>'required|string|max:225',
                    'link_name'=>'required|string|max:225',
                    'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if($validator->fails())
                {
                    return response()->json([
                    'message'=> 'All fields are required',
                    'error'=> $validator->messages(),
                    ], 422);
                }

        $slider = new Slider;
        $slider->heading = $request->input('heading');
        $slider->description = $request->input('description');
        $slider->link = $request->input('link');
        $slider->link_name = $request->input('link_name');

        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/slider/'.$filename);
            $slider->image = $filename;
           
        }
       $slider->status = $request->input('status')== true ? '1': '0';
        $slider->save();
        return redirect()->back()->with('status', 'Slider added successsfully');
    }


    // EDIT SLIDER
    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }
    // VIEW SLIDER
    public function view($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.view', compact('slider'));
    }


    // UPDATE SLIDER
      public function update(Request $request, $id)

    {
        $validator = Validator::make($request->all(),[
                    'heading' => 'required|string|max:225',
                    'description' => 'required',
                    'link'=>'required|string|max:225',
                    'link_name'=>'required|string|max:225',
                    'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'

        ]);

        if($validator->fails())
                {
                    return response()->json([
                    'message'=> 'All fields are required',
                    'error'=> $validator->messages(),
                    ], 422);
                }

        $slider = Slider::find($id);
        $slider->heading = $request->input('heading');
        $slider->description = $request->input('description');
        $slider->link = $request->input('link');
        $slider->link_name = $request->input('link_name');

        if ($request->hasFile('image'))
        {
            $destination = 'uploads/slider/'.$slider->image;
             if(File::exists($destination)) {
                File::delete($destination);
             }

             
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/slider/'.$filename);
            $slider->image = $filename;
        }
        $slider->status = $request->input('status')== true ? '1': '0';
        $slider->save();
        
        return redirect()->back()->with('status', 'Slider Updated successsfully');
    }

       //  DELETE FUNCTION
    public function destroy($id)
    {
         $slider = Slider::findOrFail( $id);
        // if ($slider->image && Storage::exists('public/sliders/' . $slider->image)) {
        //     Storage::delete('sliders/'.$slider->image);
        // }

         $slider->delete();

        return redirect()->back()->with('status', 'Slider deleted successfully.');
    }

}