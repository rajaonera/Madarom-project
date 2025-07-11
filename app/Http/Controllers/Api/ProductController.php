<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class ProductController extends Controller
{
    public function index()
    {
        $products =  Product::all();
        if (!$products) {
            return response()->json(['message' => 'Products not found'], 404);
        }
        return response()->json($products);
    }

    public function show($id)
    {
        $product =  Product::findOrFail($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }
}

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories =  SubCategory::all();
        return response()->json($subCategories);
    }
}

class CategoryController extends Controller
{
    public function index()
    {
        $categories =  Category::all();
        return response()->json($categories);
    }
}
