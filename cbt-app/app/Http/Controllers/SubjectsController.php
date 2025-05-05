<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
         $subject = Subject::paginate(5);
        return view('admin.subject.index', ['subject' => $subject]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                    $validator = Validator::make($request->all(),[
                            'name' => 'required|string|max:255',
                            'code' => 'required|numeric|unique:subjects,code',
                            'status' => 'required|boolean',
                        ]);
                        if($validator->fails())
                {
                    return response()->json([
                   'message'=> 'All fields are required',
                    'error'=> $validator->messages(),
                    ], 422);
                 }

                            $subject = new Subject();
                            $subject->name = $request->input('name');
                            $subject->code = $request->input('code');
                            $subject->status = $request->input('status')== true ? '1': '0';
                            $subject->save();

                // ✅ Redirect back with success message
                return redirect()->route('subject.index')->with('status', 'Subject created successfully!');
                                            
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    { 
        // $subject = Subject::find($id);
        // return view('admin.subject.show', compact('subject'));

         $subject = Subject::find($id);
        return view('admin.subject.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $subject = Subject::find($id);
        return view('admin.subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
      
        
                    $validator = Validator::make($request->all(),[
                            'name' => 'required|string|max:255',
                            'code' => 'required|numeric|unique:subjects,code',
                            'status' => 'required|boolean',
                        ]);
                        if($validator->fails())
                {
                    return response()->json([
                   'message'=> 'All fields are required',
                    'error'=> $validator->messages(),
                    ], 422);
                 }

                            $subject = Subject::findOrFail($id);
                            $subject->name = $request->input('name');
                            $subject->code = $request->input('code');
                            $subject->status = $request->input('status')== true ? '1': '0';
                            $subject->save();

                // ✅ Redirect back with success message
                return redirect()->route('subject.index')->with('status', 'Subject Updated successfully!');
                                 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return redirect('subject')->with('status', 'Subject deleted successfully.');
    }
}