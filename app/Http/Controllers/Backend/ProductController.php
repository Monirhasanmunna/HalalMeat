<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageSaver;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tax;
use App\Models\Unit;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Picqer\Barcode\BarcodeGeneratorPNG;

class ProductController extends Controller
{
    use ImageSaver;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Inertia::render('Product/Index');
    }


    public function getAllItems()
    {
        $categories = Category::where('status', true)->get();
        $brands = Brand::where('status', true)->get();
        $units = Unit::where('status', true)->get();

        $products = Product::with(['category','brand', 'unit'])->orderByDesc('id')->get();

        return response()->json([
            'status' => 200,
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
            'units' => $units
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'description' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'unit_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'purchase_price' => 'required',
            'selling_price' => 'required',
        ]);


        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'unit_id' => $request->unit_id,
            'description' => $request->description,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'quantity' => 0
        ]);


        if($request->hasFile('image')) {
            $this->upload_file($request->file('image'), $product, 'image', 'product');
        }


        return response()->json([
            'status' => 200,
            'product' => $product
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
    public function edit(string $id)
    {
        $product = Product::with(['category', 'brand', 'unit'])->find($id);
        return response()->json([
            'status' => 200,
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|unique:products,name,'.$id,
            'description' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'unit_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'purchase_price' => 'required',
            'selling_price' => 'required',
        ]);


        $product = Product::find($id);

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'unit_id' => $request->unit_id,
            'description' => $request->description,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'quantity' => 0
        ]);


        if($request->hasFile('image')) {
            $this->upload_file($request->file('image'), $product, 'image', 'product');
        }


        return response()->json([
            'status' => 200,
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product->image) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return response()->json([
            'status' => 200
        ]);
    }
}
