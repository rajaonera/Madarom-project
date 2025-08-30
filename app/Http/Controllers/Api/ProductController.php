<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use http\Env\Response;

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

    // public function index_details(): \Illuminate\Http\JsonResponse
    // {
    //     $products = Product::with('activePrice')->get();
    
    //     if ($products->isEmpty()) {
    //         return response()->json(['message' => 'Products not found'], 404);
    //     }
    
    //     // Si tu veux retourner avec ProductResource, il faut adapter la resource aussi
    //     return response()->json(ProductResource::collection($products));
    // }

    public function index_details(): \Illuminate\Http\JsonResponse
    {
        $products =  Product::with('activePrice')->get();

        if (!$products) {
            return response()->json(['message' => 'Products not found'], 404);
        }
        return response()->json(ProductResource::collection($products)) ;
    }
    
    
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $product =  Product::findOrFail($id);
        return response()->json($product);
    }

    public function details_show($id): \Illuminate\Http\JsonResponse
    {
        $product =  Product::with('activePrice')->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json(new  ProductResource($product)) ;
    }

    // public function details_show($id): \Illuminate\Http\JsonResponse
    // {
    //     $product =  Product::with('activePrice')->findOrFail($id);
    //     return response()->json(new ProductResource($product));

    // }
}
