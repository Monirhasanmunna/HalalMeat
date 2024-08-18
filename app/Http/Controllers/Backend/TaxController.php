<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $count = $request->input('count');

        $query = Tax::query();

        $taxes = $query->orderByDesc('id')
                    ->Search($search)
                    ->paginate($count)
                    ->withQueryString();
        
        return Inertia::render('Tax/Index',[
            'taxes' => $taxes,
            'filters' => ['search' => $search , 'count' => $count]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:taxes',
            'percentage' => 'required|unique:taxes',
        ]);

        $tax = new Tax();
        $tax->name = $request->name;
        $tax->percentage = $request->percentage;
        $tax->save();


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
        $tax = Tax::where('id', $id)->first();
        return response()->json($tax);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:taxes,name,'. $id,
            'percentage' => 'required|unique:taxes,percentage,'. $id,
        ]);

        $tax = Tax::where('id', $id)->first();
        $tax->name = $request->name;
        $tax->percentage = $request->percentage;
        $tax->status = $request->status;
        $tax->save();


        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tax = Tax::find($id);

        $tax->delete();
        return Redirect::back();
    }
}
