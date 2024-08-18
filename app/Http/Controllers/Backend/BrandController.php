<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;
use App\Http\Traits\ImageSaver;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    use ImageSaver;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Brand/Index');
    }


    public function getAllItems()
    {
        $brands = Brand::orderByDesc('id')->get();

        return response()->json([
            'status' => 200,
            'brands' => $brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:brands',
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->save();


        if ($request->hasFile('image')) {
            $this->upload_file($request->file('image'), $brand, 'image', 'brand');
        }

        return response()->json([
            'status' => 200,
            'brand' => $brand
        ]);
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
    public function edit($id)
    {
        $brand = Brand::where('id', $id)->first();

        return response()->json([
            'status' => 200,
            'brand' => $brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:brands,name,'. $id,
        ]);

        $brand = Brand::where('id', $id)->first();
        $brand->name = $request->name;
        $brand->status = $request->status;
        $brand->slug = Str::slug($request->name);
        $brand->save();


        if ($request->hasFile('image')) {
            $this->upload_file($request->file('image'), $brand, 'image', 'brand');
        }

        return response()->json([
            'status' => 200,
            'brand'  => $brand
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);

        if(File::exists(public_path($brand->image))){
            File::delete(public_path($brand->image));
        }
        
        $brand->delete();
        
        return response()->json([
            'status' => 200,
        ]);
    }
}
