<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        return Inertia::render('Frontend/Category');
    }

    public function featuredCategory()
    {
        $featuredCategories = Category::Featured()->get()->take(5);
        return response()->json($featuredCategories);
    }
}
