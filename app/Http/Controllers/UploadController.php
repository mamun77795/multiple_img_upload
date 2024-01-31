<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function index()
    {
        return response()->json(['success'=>'This is test purpose']);
    }

    public function create()
    {
        return view('make');
    }

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


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
