<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('student.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::all();
        return view('student.create', compact('students'));
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
    public function edit(Request $request)
    {
        $student = Student::find($request->id);
        return response()->json(['data'=>$student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'images.*'=>'image|mimes:jpeg,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('images')){
            $image = $request->file('images');
            $imageName = time()."-".$image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            $student = Student::find($request->id);
            $path = public_path('uploads/'. $student->photo);
            if(File::exists($path)){
                File::delete($path);
            }
        }else{
            $imageName = $request->photo;
        }

        $data =[
            'name'=>$request->name,
            'email'=>$request->email,
            'photo'=> $imageName
        ];

        $id = $request->id;
        Student::where('id', $id)->update($data);

        return response()->json(['data'=>'successfully updated!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $student = Student::find($request->id);
        $filePath = public_path('uploads/' . $student->photo);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        $student->delete();
        
        return response()->json(['data'=>'data successfully deleted']);
    }
}
