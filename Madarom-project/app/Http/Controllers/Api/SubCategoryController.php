<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $subCategories = SubCategory::all();
        return response()->json($subCategories);
    }
}
