<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $session = Session::all();
        return view('admin.session.index', compact('session'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.session.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $session = Session::find($id);
        return view('admin.session.show', compact('session'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $session = Session::find($id);
        return view('admin.session.edit', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session, string $id)
    {
        $session = Session::find($id)->delete();
        return redirect()->back()->with('status', 'Session Delete Successfully');
    }
}