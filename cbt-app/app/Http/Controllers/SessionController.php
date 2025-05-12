<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $section = Section::all();
        return view('admin.section.index', compact('section'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.section.create');
    }


    // ACTIVE TOGGLE
    
        // Session::where('is_active', true)->update(['is_active'=>false]);
        // Session::where('id', $newActiveId)->update(['is_active'=>true]);

        // $activeSession = Session::where('is_active', true)->first();
             
//   const $isActive => $request->has('is_active')
//    if($isActive){
//     Session::where('is_active', true)->update('is_active', false)
//    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sections,name',
        ]);

        Section::create([
            'name'=> $request->name,
            // 'is_active'=>$request-> $isActive,
        ]);
         return redirect()->route('section.index')->with('status', 'Section Added Successfully');

    }

   
    public function show(string $id)
    {
        $session = Section::find($id);
        return view('admin.section.show', compact('section'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $session = Section::find($id);
        return view('admin.section.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //   $request->validate([
        //     'name' => 'required|unique:sections,name' . $section->id,
        // ]);
        // Section::update([
        //     'name' => $request->name,
        //     'is_active' => $request->$isActive,

        // ]);
        //  return redirect()->route('section.index')->with('status', 'Section Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section, string $id)
    {
        $section = Section::find($id)->delete();
        return redirect()->back()->with('status', 'section Delete Successfully');
    }
}