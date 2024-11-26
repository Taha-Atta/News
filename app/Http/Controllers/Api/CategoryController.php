<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\PostCollection;
use App\Models\Category;
use Illuminate\Http\Request;

use function App\Http\ApiResponse;

class CategoryController extends Controller
{
    public function allCategories()
    {
        $categories =  Category::active()->get();
        if (!$categories) {
            return ApiResponse(404, 'no categories');
        }
        return ApiResponse(200, 'categories found', new CategoryCollection($categories));
    }

    public function CategoriesPosts($slug)
    {
        $category =  Category::whereSlug($slug)->first();
        if (!$category) {
            return ApiResponse(404, 'no category');
        }

        $posts = $category->posts;
        if (!$posts) {
            return ApiResponse(404, 'no posts');
        }
        return ApiResponse(200, 'post in this category found', new PostCollection($posts));

    }
}
