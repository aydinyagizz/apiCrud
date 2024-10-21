<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use const http\Client\Curl\AUTH_DIGEST;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //return Auth::user();
            //listeleme
            $product = Product::all();
            return $product;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            //kayıt
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;

            $product->save();
            return response()->json(['message', 'Ürün Kaydedildi.']);
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
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;

        $product->save();
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //silme işlemi için kullanılacak
         Product::destroy($id);
        return response()->json(['message', 'Silme Başarılı.']);
    }
}
