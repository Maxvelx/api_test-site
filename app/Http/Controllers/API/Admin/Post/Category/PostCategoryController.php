<?php

namespace App\Http\Controllers\API\Admin\Post\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Admin\Post\Category\StorePostCategoryRequest;
use App\Http\Requests\API\Admin\Post\Category\UpdatePostCategoryRequest;
use App\Models\Post\PostCategory;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PostCategory::latest()->paginate(10, ['*'], 'page');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostCategoryRequest $request)
    {
        PostCategory::firstOrCreate($request->validated());

        return response(status: 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostCategoryRequest $request, PostCategory $postCategory)
    {
        $postCategory->update($request->validated());

        return response(status: 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostCategory $postCategory)
    {
        $postCategory->delete();

        return response(status: 200);
    }
}
