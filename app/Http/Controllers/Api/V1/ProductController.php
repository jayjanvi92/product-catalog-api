<?php

namespace App\Http\Controllers\Api\V1;

use App\BO\ProductBO;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    // public function index(Request $request): JsonResponse
    // {
    //     $search = $request->query('search');
    //     return response()->json([
    //         'success' => true,
    //         'data' => $this->productRepository->getAll(10, $search),
    //     ]);
    // }

    public function index(Request $request): JsonResponse
    {
        try {
            $search = $request->query('search');
            $perPage = $request->query('limit', 10); // Default to 10
            $page = $request->query('page', 1);
            $categoryId = $request->query('category_id');
            if (!empty($search) || !empty($categoryId)) {
                $page = 1;
            }
            $products = $this->productRepository->getAll($perPage, $search, $categoryId, $page);
            return response()->json([
                'success' => true,
                'total' => $products->total(),
                'page' => $products->currentPage(),
                'limit' => $products->perPage(),
                'data' => $products->items(),
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    

    

    public function show($id): JsonResponse
    {
        $product = $this->productRepository->findById($id);
        if (!$product) {
            throw new ModelNotFoundException();
        }
        return response()->json(['success' => true, 'data' => $product]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'sku' => 'required|string|unique:products',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $productBO = new ProductBO($validated);
        $product = $this->productRepository->create($productBO);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully!',
            'data' => $product,
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'description' => 'sometimes|string',
                'sku' => "sometimes|string|unique:products,sku,{$id}",
                'price' => 'sometimes|numeric|min:0',
                'category_id' => 'sometimes|exists:categories,id',
            ]);
    
            $productBO = new ProductBO($validated);
            $updated = $this->productRepository->update($id, $productBO);
    
            if (!$updated) {
                return response()->json(['success' => false, 'message' => 'Product not found or update failed'], 404);
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully!',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function destroy($id): JsonResponse
    {
        if (!$this->productRepository->delete($id)) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Product deleted']);
    }
}
