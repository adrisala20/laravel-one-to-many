<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view("admin.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
        ]);
        $form_data = $request->all();
        $form_data['slug'] = Category::generateSlug($form_data['name']);
        $newCategory = Category::create($form_data);
        return redirect()->route('admin.categories.show', $newCategory->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //dd($category);
        return view("admin.categories.show", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:200',
        ]);
        $form_data = $request->all();
        if ($category->name !== $form_data['name']) {
            $form_data['slug'] = Category::generateSlug($form_data['name']);
        }
        $category->update($form_data);
        return redirect()->route('admin.categories.show', $category->slug);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('message', $category->name . ' è stato eliminato');
    }
}

