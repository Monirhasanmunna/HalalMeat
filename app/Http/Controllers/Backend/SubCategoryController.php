<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('SubCategory/Index');
    }

    public function getAllItems()
    {
        $subCategories = SubCategory::with('category')->orderByDesc('id')->get();

        return response()->json([
            'status' => 200,
            'subCategories' => $subCategories
        ]);
    }

    public function Categories()
    {
        $categories = CategoryResource::collection(Category::orderByDesc('id')->get());
        
        return response()->json([
            'status' => 200,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required'
        ]);

        $subCategory = SubCategory::create([
            'name' => $request->name,
            'category_id' => $request->category
        ]);

        return response()->json([
            'status' => 200,
            'subCategory' => $subCategory
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
        $subCategory = SubCategory::with('category')->find($id);

        return response()->json([
            'status' => 200,
            'subCategory' => $subCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required'
        ]);

        $subCategory = SubCategory::with('category')->find($id);
        
        $subCategory->update([
            'name' => $request->name,
            'category_id' => $request->category
        ]);

        return response()->json([
            'status' => 200,
            'subCategory' => $subCategory
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::find($id);

        $subCategory->delete();

        return response()->json([
            'status' => 200
        ]);
    }
}
