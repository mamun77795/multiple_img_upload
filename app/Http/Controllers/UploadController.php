<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['success'=>'This is test purpose']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('make');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $images = [];

        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $imageName = time().'-'.$image->getClientOriginalName();
                $image->move(public_path('uploads'), $imageName);
                $images[] = ['img_name'=>$imageName, 'product_name' => $request->name];
            }
        }

        Upload::insert($images);

        $data = [
            'product_name' => $request->name,
            'description' => $request->description
        ];

        Product::insert($data);

        return response()->json(['data' => $request->name]);
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
