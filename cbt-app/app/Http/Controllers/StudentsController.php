<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

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



// GENERATE RANDOM NUMBER/ALPHABET
    function generateRegistrationNumber($length = 11)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    return substr(str_shuffle(str_repeat($characters, $length)), 0, $length);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           $validator = Validator::make($request->all(),[
                    'surname' => 'required|string|max:255',
                    'first_name' => 'required|string|max:255',
                    'other_name' => 'nullable|string|max:255',
                    'email' => 'required|email|unique:students,email',
                    'password' => 'required|min:6|confirmed',
                    'phone' => 'required|digits_between:10,15',
                    'gender' => 'required|in:male,female',
                    'state' => 'required|string',
                    'country' => 'required|string',
                    'registration_number' => 'required|unique:students,registration_number',
                    'address' => 'nullable|string',
                    'dob' => 'required|date',
                    'role' => 'required|string|in:student,admin',
                    'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                    'status' => 'required|boolean',
                        ]);
                        if($validator->fails())
                {
                    return response()->json([
                   'message'=> 'All fields are required',
                    'error'=> $validator->messages(),
                    ], 422);
                 }

      try {
              
               if ($request->hasFile('image')) {
                 $path = $request->file('image')->store('/students', 'public');
             Storage::url($path);

              $student = new Students();
                $student->surname = $request->surname;
                $student->first_name = $request->first_name;
                $student->other_name = $request->other_name;
                $student->email = $request->email;
                $student->password = Hash::make($request->surname . 'pass');;
                $student->phone = $request->phone;
                $student->gender = $request->gender;
                $student->state = $request->state;
                $student->country = $request->country;
                $student->address = $request->address;
                $student->registration_number = $this->generateRegistrationNumber();
                $student->dob = $request->dob;
                $student->status = $request->status == true ? '1' : '0';
                $student->image = $path;
                $student->save();

                
                return redirect('admin.student')->with('status', 'Student Updated Successfully');
         
            }

            
               

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
    public function update(Request $request, $id)
    {
         
           $validator = Validator::make($request->all(),[
                    'surname' => 'required|string|max:255',
                    'first_name' => 'required|string|max:255',
                    'other_name' => 'nullable|string|max:255',
                    'email' => 'required|email|unique:students,email',
                    'password' => 'required|min:6|confirmed',
                    'phone' => 'required|digits_between:10,15',
                    'gender' => 'required|in:male,female',
                    'state' => 'required|string',
                    'country' => 'required|string',
                    'registration_number' => 'required|unique:students,registration_number',
                    'address' => 'nullable|string',
                    'dob' => 'required|date',
                    'role' => 'required|string|in:student,admin',
                    'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                    'status' => 'required|boolean',
                        ]);
                        if($validator->fails())
                {
                    return response()->json([
                   'message'=> 'All fields are required',
                    'error'=> $validator->messages(),
                    ], 422);
                 }

      try {
               $student = Students::findOrFail($id); 
               if ($request->hasFile('image')) {
          
                if ($student->image && Storage::disk('public')->exists($student->image)) {
                Storage::disk('public')->delete($student->image);
                }

                // Save new image
                $path = $request->file('image')->store('students', 'public');
                $student->image = $path;
    }

            // Update other fields (even if no new image)
                $student->surname = $request->surname;
                $student->first_name = $request->first_name;
                $student->other_name = $request->other_name;
                $student->email = $request->email;
                $student->password = Hash::make($request->surname . 'pass');;
                $student->phone = $request->phone;
                $student->gender = $request->gender;
                $student->state = $request->state;
                $student->country = $request->country;
                $student->address = $request->address;
                $student->registration_number = $this->generateRegistrationNumber();
                $student->dob = $request->dob;
                $student->status = $request->status == true ? '1' : '0';
                $student->save();

                 
                return redirect('admin.student')->with('status', 'Student Updated Successfully');

            } 
            catch (Exception $th) {
                return redirect('add-student')->with('fail', $th->getMessage());
            };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Students $students, $id)
    {
        
            $student = Students::findOrFail($id);
            
            if ($student->image && Storage::disk('public')->exists($students->image)) {
                Storage::disk('public')->delete($student->image);
            }
            
            $student = delete();
            return Redirect('admin.index')->back()->with('status', 'Student Delete Successfully');
        
        }
    
}