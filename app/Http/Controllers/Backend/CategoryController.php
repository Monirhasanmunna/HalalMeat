<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Traits\ImageSaver;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    use ImageSaver;

    public function index()
    {
        return Inertia::render('Category/Index');
    }

    public function getAllItems()
    {
        $categories = Category::orderByDesc('id')->get();

        return response()->json([
            'status' => 200,
            'categories' => $categories
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = true;
        $category->save();


        if ($request->hasFile('image')) {
            $this->upload_file($request->file('image'), $category, 'image', 'category');
        }

        return response()->json([
            'status' =>200,
            'category' => $category
        ]);
    }

 
    public function edit($id)
    {
        $category = Category::find($id);

        return response()->json([
            'status' => 200,
            'category' => $category
        ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,'. $id,
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->status = $request->status;
        $category->slug = Str::slug($request->name);
        $category->save();


        if ($request->hasFile('image')) {
            $this->upload_file($request->file('image'), $category, 'image', 'category');
        }

        return response()->json([
            'status' => 200,
            'category' => $category
        ]);
    }


    public function destroy($id)
    {
        $category = Category::find($id);

        if(File::exists(public_path($category->image))){
            File::delete(public_path($category->image));
        }
        
        $category->delete();

        return response()->json([
            'status' => 200,
        ]);
    }
}
