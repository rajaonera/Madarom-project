<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
//        maka liste produits
        print ("liste produits");
        $products =  Product::all();
        if (!$products) {
            return response()->json(['message' => 'Products not found'], 404);
        }
        return response()->json($products);
    }

    public function index_details(): \Illuminate\Http\JsonResponse
    {
        print ("mandeha");
        $products =  Product::with('activePrice')->get();
        foreach ($products as $product) {
            print ($product->activePrice->amount);
        }
        if (!$products) {
            return response()->json(['message' => 'Products not found'], 404);
        }
        return response()->json(ProductResource::collection($products)) ;
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        print ("show");
        $product =  Product::where('id', $id)->firstOrFail();
        if (!$product) {
            return response()->json(['message' => 'Products not found'], 404);
        }
        return response()->json($product);
    }

    public function details_show($id): \Illuminate\Http\JsonResponse
    {
        print ("mandeha 2");
        $product =  Product::with('activePrice')->find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json(new  ProductResource($product)) ;
    }
}
