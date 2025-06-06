<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    
    public function index()
    {
        $section = Section::all();
        return view('admin.section.index', compact('section'));
    }

    
    public function create()
    {
         return view('admin.section.create');
    }

 
    public function store(Request $request)
    {

                    
    $isActive = $request->has('is_active');
    if($isActive){
     Section::where('is_active', true)->update(['is_active'=> false]);
   }
 
        $request->validate([
            'name' => 'required|string|max:255|unique:sections,name',
        ]);

        
        Section::create([
            'name' => $request->name,
            'is_active'=> $isActive,
        ]);
         return redirect()->route('section.index')->with('status', 'Session Created Successfully');

    }

   
    public function show(string $id)
    {
        $section = Section::findOrFail($id);;
        return view('admin.section.show', compact('section'));
        
    }

   
    public function edit(string $id)
    {
        $section = Section::findOrFail($id);;
        return view('admin.section.edit', compact('section'));
    }

   
    public function update(Request $request,  Section $section, $id)
    {
          $isActive = $request->has('is_active');
            if($isActive){
        Section::where('is_active', true)->update(['is_active'=> false]);
   }
          $request->validate([
             'name' => 'required|unique:sections,name' . $section->id,
        ]);
        $section = Section::findOrFail($id);
        $section->update([
            'name' => $request->name,
            'is_active' => $isActive,

         ]);
          return redirect()->route('section.index')->with('status', 'Session Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section, $id)
    {
        $section = Section::findOrFail($id);;
        $section->delete();
        return redirect()->back()->with('status', 'Session Delete Successfully');
    }
}