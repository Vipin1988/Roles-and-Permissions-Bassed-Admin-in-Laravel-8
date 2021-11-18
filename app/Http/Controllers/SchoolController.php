<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:school-list|school-create|school-edit|school-delete', ['only' => ['index','show']]);
         $this->middleware('permission:school-create', ['only' => ['create','store']]);
         $this->middleware('permission:school-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:school-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::latest()->paginate(5);
        return view('schools.index',compact('schools'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schools.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        School::create($request->all());
    
        return redirect()->route('schools.index')
                        ->with('success','School created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\School  $School
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return view('schools.show',compact('school'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $School
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        return view('schools.edit',compact('school'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $School
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
         request()->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        $school->update($request->all());
    
        return redirect()->route('schools.index')
                        ->with('success','School updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $School
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();
    
        return redirect()->route('schools.index')
                        ->with('success','School deleted successfully');
    }
}
