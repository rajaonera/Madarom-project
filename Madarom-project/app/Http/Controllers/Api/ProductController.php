<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class ProductController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
//        maka liste produits
        $products =  Product::all();
        if (!$products) {
            return response()->json(['message' => 'Products not found'], 404);
        }
        return response()->json($products);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $product =  Product::findOrFail($id);
        return response()->json($product);
    }
}
