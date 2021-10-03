<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\CacheRemember;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return Category::get(['title']);
        }
        $categories = (new CacheRemember)->getCache('category');

        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @ param  \Illuminate\Http\Request  $request
     * @ return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());

        (new CacheRemember())->cacheCategory();
        return redirect('api/categories/index')->with('success', 'Category is created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category  = Category::findOrFail($id);

        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());

        (new CacheRemember())->cacheCategory();
        return redirect('api/categories/index')->with('success', 'Category is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // prevent from deleteing necessary category with malicious intent
        if ($category->is_deletable === 0) {
            return redirect()->back()->with('error', 'Category can not be deleted');
        }

        $category->delete();

        (new CacheRemember())->cacheCategory();
        return redirect('api/categories/index')->with('success', 'Category is deleted successfully');
    }
}
