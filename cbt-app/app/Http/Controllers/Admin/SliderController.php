<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index()
    {
        $slider = Slider::all()->paginate(10);
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
                    'description' => 'nullable|string|',
                    'link'=>'nullable|string|url|max:225',
                    'link_name'=>'nullable|string|max:225',
                    'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // if($validator->fails())
        //         {
        //             return response()->json([
        //             'message'=> 'All fields are required',
        //             'error'=> $validator->messages(),
        //             ], 422);
        //         }

       

        try {
           if ($request->hasFile('image'))
        {
            $path = $request->file('image')->store('/sliders', 'public');
             Storage::url($path);


            $slider = new Slider();
            $slider->heading = $request->input('heading');
            $slider->description = $request->input('description');
            $slider->link = $request->input('link');
            $slider->link_name = $request->input('link_name');
            $slider->image = $path;
           
            $slider->status = $request->input('status')== true ? '1': '0';
            $slider->save();
            return redirect('add-slider')->with('status', 'Slider Added Successfully');
        }

        
        } catch (Exception $th) {
            //throw $th;
        return redirect('add-slider')->with('fail', $th->getMessage());

        }
    }


    // EDIT SLIDER
    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }
    // VIEW SLIDER
    public function show($id)
    {
        $slider = Slider::find($id);
        return view('admin.slider.show', compact('slider'));
    }


    // UPDATE SLIDER
      public function update(Request $request, $id)

    {
        $validator = Validator::make($request->all(),[
                   'heading' => 'required|string|max:225',
                    'description' => 'nullable|string|',
                    'link'=>'nullable|string|url|max:225',
                    'link_name'=>'nullable|string|max:225',
                    'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048'

        ]);

        // if($validator->fails())
        //         {
        //             return response()->json([
        //             'message'=> 'All fields are required',
        //             'error'=> $validator->messages(),
        //             ], 422);
        //         }

      try {
             $slider = Slider::findOrFail($id); 

          
            if ($request->hasFile('image')) {
          
           if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }

        // Save new image
        $path = $request->file('image')->store('sliders', 'public');
        $slider->image = $path;
    }

    // Update other fields (even if no new image)
    $slider->heading = $request->input('heading');
    $slider->description = $request->input('description');
    $slider->link = $request->input('link');
    $slider->link_name = $request->input('link_name');
    $slider->status = $request->input('status') == true ? '1' : '0';
    $slider->save();

    return redirect('add-slider')->with('status', 'Slider Updated Successfully');
    } catch (Exception $th) {
        return redirect('add-slider')->with('fail', $th->getMessage());
    }

    }

       //  DELETE FUNCTION
    public function destroy(Slider $slider, $id)
    {
         $slider = Slider::findOrFail($id);
        // Delete image file
    if ($slider->image && Storage::disk('public')->exists($slider->image)) {
        Storage::disk('public')->delete($slider->image);
    }

         $slider->delete($id);
        return redirect('add-slider')->with('status', 'Slider deleted successfully.');
    }

}