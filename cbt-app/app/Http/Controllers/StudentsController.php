<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Student;
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
        $student = Student::all();
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
                    'password' => 'min:8|confirmed',
                    'phone' => 'required|string|regex:/^(\+?\d{10,20})$/',
                    'gender' => 'required|in:male,female',
                    'state' => 'required|string',
                    'country' => 'required|string',
                    'registration_number' => 'unique:students,registration_number',
                    'address' => 'nullable|string|max:300',
                    'dob' => 'required|date',
                    'role' => 'digits|in:2,1',
                    'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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

                $student = new Student();
                $student->surname = $request->input('surname');
                $student->first_name = $request->first_name;
                $student->other_name = $request->other_name;
                $student->email = $request->email;
                $student->password = Hash::make($request->surname.'pass');;
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
                return redirect()->route('student.index')->with('status', 'Student Registered Successfully');
      
            }

            } 
            catch (Exception $th) {
                return redirect()->route('student.create')->with('fail', $th->getMessage());
            }

                
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $student = Student::find($id);
        return view('admin.student.show', compact('student'));
    }

   
    public function edit( $id)
    {
         $student = Student::find($id);
        return view('admin.student.edit', compact('student'));
    }

   
    public function update(Request $request, $id)
    {
         $student = Student::findOrFail($id); 
           $validator = Validator::make($request->all(),[
                    'surname' => 'required|string|max:255',
                    'first_name' => 'required|string|max:255',
                    'other_name' => 'nullable|string|max:255',
                    'email' => 'required|email|unique:students,email,'.$student->id,
                    'password' => 'min:8|confirmed',
                    'phone' => 'required|string|regex:/^(\+?\d{10,20})$/',
                    'gender' => 'required|in:male,female',
                    'state' => 'required|string',
                    'country' => 'required|string',
                    'registration_number' => 'string|unique:students,registration_number,' . $student->id,
                    'address' => 'nullable|string',
                    'dob' => 'required|date',
                    'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                    
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
          
                if ($student->image && Storage::disk('public')->exists($student->image)) {
                Storage::disk('public')->delete($student->image);
                }

                // Save new image
                $path = $request->file('image')->store('students', 'public');
                $student->image = $path;
    }

     if ($request->filled('password')) {
        $student->password = bcrypt($request->input('password'));
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

                 
                  return redirect()->route('student.index')->with('status', 'Student Updated Successfully');

            } 
            catch (Exception $th) {
                return redirect()->route('student.edit')->with('fail', $th->getMessage());
            };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        
              $student = Student::findOrFail($id);           
            if ($student->image && Storage::disk('public')->exists($student->image)) {
                Storage::disk('public')->delete($student->image);
            }
            
            $student->delete();
           
    return redirect()->route('student.index')->with('status', 'Student deleted successfully.');
        
        }
    
}