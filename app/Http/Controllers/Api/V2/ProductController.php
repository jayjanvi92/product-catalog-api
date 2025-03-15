<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::select('id', 'name', 'price')->paginate(10);
        return response()->json(['success' => true, 'data' => $products]);
    }
}
