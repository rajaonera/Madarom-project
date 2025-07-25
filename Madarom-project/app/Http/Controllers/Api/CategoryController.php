<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $categories = Category::all();
        return response()->json($categories);
    }
}
