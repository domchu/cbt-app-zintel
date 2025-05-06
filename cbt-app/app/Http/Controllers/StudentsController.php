<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Students::latest()->paginate(15);
        return view('admin.student.index', [ 'student' => $student]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           $validator = Validator::make($request->all(),[
                            'surname' => 'required|string|max:255',
                            'first_name' => 'required|string|max:255',
                            'other_name' => 'required|string|max:255',
                            'email' => 'required|string|max:255',
                            'password' => 'required|string|max:255',
                            'phone' => 'required|numeric|max:25',
                            'gender' => 'required|string|max:255',
                            'state' => 'required|string|max:255',
                            'country' => 'required|string|max:255',
                            'address' => 'required|string',
                            'registration_number' => 'required|numeric|unique:subjects,code',
                            'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                            'dob' => 'required|string',
,                            'status' => 'required|boolean',
                        ]);
                        if($validator->fails())
                {
                    return response()->json([
                   'message'=> 'All fields are required',
                    'error'=> $validator->messages(),
                    ], 422);
                 }

      try {
                $student = new Students(); 
        if ($request->hasFile('image')) {
          
                if ($student->image && Storage::disk('public')->exists($student->image)) {
                Storage::disk('public')->delete($student->image);
               }

                // Save new image
                $path = $request->file('image')->store('students', 'public');
                $student->image = $path;
    }

            // Update other fields (even if no new image)
                $student->surname = $request->input('surname');
                $student->first_name = $request->input('first_name');
                $student->other_name = $request->input('other_name');
                $student->email = $request->input('email');
                $student->password = $request->input('password');
                $student->phone = $request->input('phone');
                $student->gender = $request->input('gender');
                $student->state = $request->input('state');
                $student->country = $request->input('country');
                $student->address = $request->input('address');
                $student->registration_number = $request->input('registration_number');
                $student->dob = $request->input('dob');
                $student->status = $request->input('status') == true ? '1' : '0';
                $student->save();

                 // ✅ Redirect back with success message
                return redirect('add-student')->with('status', 'Student Updated Successfully');

            } 
            catch (Exception $th) {
                return redirect('add-student')->with('fail', $th->getMessage());
            }

                
    }

    /**
     * Display the specified resource.
     */
    public function show(students $students, $id)
    {
        $students = Students::findOrFail($id);
        return view('admin.student.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(students $students, $id)
    {
         $students = Students::findOrFail($id);
        return view('admin.student.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, students $students)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(students $students, $id)
    {
        //
        $student = Students::findOrFail($id);
        $student = delete();
        return Redirect()->back()->with('status', 'Student Delete Successfully');

    }
}