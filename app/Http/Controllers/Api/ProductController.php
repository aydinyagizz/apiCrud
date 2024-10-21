<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Resources\ProductResource;
use App\Services\Interfaces\ProductInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use const http\Client\Curl\AUTH_DIGEST;
use App\Enums\ResponseCode;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private ProductInterface $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    public function index() : JsonResponse
    {
        return response()->json([
            'status' => ResponseCode::SUCCESS->value,
            'data' => ProductResource::collection($this->product->index())
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : JsonResponse
    {
            //kayıt

        $product = new Product();
        $product->fill($request->all()); // Kitle atama
        $this->product->store($product);

        return response()->json([
            'status' => ResponseCode::SUCCESS,
            'message' => 'Ürün ekleme başarılı',
            'data' => new ProductResource($product)
        ], 201);

    }

    /**
     * Display the specified resource.
     */
//    public function show(string $id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id) : JsonResponse
    {

        $updated = $this->product->update($request, (int) $id);

        if (!$updated) {
            return response()->json([
                'status' => ResponseCode::ERROR,
                'message' => 'Ürün bulunamadı',
            ], 404);
        }

        return response()->json([
            'status' => ResponseCode::SUCCESS,
            'message' => 'Ürün güncelleme başarılı',
            'data' => new ProductResource(Product::find($id)),
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //silme işlemi için kullanılacak


        $this->product->delete($id);

        return response()->json([
            'status' => ResponseCode::SUCCESS,
            'message' => 'Ürün silme başarılı',
        ], 200);
    }
}
