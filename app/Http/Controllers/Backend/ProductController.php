<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tax;
use App\Models\Unit;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Traits\generateUniqueSKU;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Picqer\Barcode\BarcodeGeneratorPNG;

class ProductController extends Controller
{
    use generateUniqueSKU;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $count = $request->input('count');

        $products = Product::with(['category', 'tax', 'brand', 'unit', 'images', 'details'])
                    ->orderByDesc('id')
                    ->Search($search)
                    ->paginate($count)
                    ->withQueryString();

        // return $products;
        
        return Inertia::render('Product/Index',[
            'products' => $products,
            'filters' => ['search' => $search , 'count' => $count]
        ]);

    }

    /**
     * Show the form for getAllData a new resource.
     */
    public function getAllData()
    {
        $categories = Category::where('status', true)->get();
        $brands = Brand::where('status', true)->get();
        $units = Unit::where('status', true)->get();
        $taxes = Tax::where('status', true)->get(); 


        return response()->json([
            'categories' => $categories,
            'brands' => $brands,
            'units' => $units,
            'taxes' => $taxes
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
            'tax_id' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'purchase_price' => 'required',
            'selling_price' => 'required',
        ]);


        $product = new Product();
        $product->name = $request->name;
        $product->barcode = $this->generateUniqueSKU();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->unit_id = $request->unit_id;
        $product->tax_id = $request->tax_id;
        $product->save();


        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($product->barcode, $generator::TYPE_CODE_128);
        $barcode_path = 'uploads/barcodes/' . $product->barcode . '.png';
        Storage::disk('public')->put($barcode_path, $barcode);
        $product->barcode_path = $barcode_path;
        $product->save();


        $product->details()->create([
            'product_id' => $product->id,
            'description' => $request->description,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
        ]);


        foreach ($request->images as $key => $image) {
            $newFileName   = $this->generateUniqueSKU() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads/products', $newFileName, 'public');

            $product->images()->create([
                'product_id' => $product->id,
                'image' => 'uploads/products/'.$newFileName
            ]);
        }


        return Redirect::back();
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
        $product = Product::with(['category', 'tax', 'brand', 'unit', 'images', 'details'])->find($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|unique:products,name,'. $id,
            'description' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'unit_id' => 'required',
            'tax_id' => 'required',
            'purchase_price' => 'required',
            'selling_price' => 'required',
        ]);


        $product = Product::find($id);
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->unit_id = $request->unit_id;
        $product->tax_id = $request->tax_id;
        $product->save();


        $product->details()->update([
            'product_id' => $product->id,
            'description' => $request->description,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
            'quantity' => $request->quantity
        ]);


        if($request->hasFile('images')) { 

            foreach ($product->images as $file) {
                if(file_exists($file->image)){
                     unlink($file->image);
                }
               
                $file->delete();
            }

            foreach ($request->images as $key => $image) {
                $newFileName   = $this->generateUniqueSKU().'.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('uploads/products', $newFileName, 'public');
    
                $product->images()->create([
                    'product_id' => $product->id,
                    'image' => 'uploads/products/'.$newFileName
                ]);
            }
        }


        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ('storage/'.$product->barcode_path) {
            unlink(public_path('storage/'.$product->barcode_path));
        }

        // Delete the associated images
        foreach ($product->images as $image) {
            if ('storage/'.$image->image) {
                unlink(public_path('storage/'.$image->image));
            }
        }

        $product->delete();
    }
}
