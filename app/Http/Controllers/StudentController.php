<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images.*'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $name = $request->name;
        $email = $request->email;
        if($request->hasFile('images')){
            $image = $request->file('images');
            $imgageName = time().$image->getClientOriginalName();
            $image->move(public_path('uploads'), $imgageName);
        }

        Student::insert([
            'name'=>$name,
            'email'=>$email,
            'photo'=>$imgageName
        ]);

        return response()->json(['data'=>'successfully inserted!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
