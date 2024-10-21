<?php

namespace App\Services\Repositories;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\Interfaces\ProductInterface;
//use App\Services\Interfaces\ProductRequest;
use Illuminate\Support\Collection;

class ProductRepository implements ProductInterface
{

    public function index(): Collection
    {
        return Product::all();
    }

    public function productById(int $id): ?Product
    {
        return Product::query()->find($id);
        // return Product::find($id);
    }

    public function store(Product $model): bool
    {
        return $model->save();
    }

    public function update(ProductRequest $request, int $id): bool
    {
       // return Product::query()->find($id)->update($request->all());
        // Ürünü bul
        $product = Product::find($id);

        // Eğer ürün yoksa, false döndür
        if (!$product) {
            return false;
        }

        // Ürünü güncelle
        return $product->update($request->all());

    }

    public function delete(int $id): bool
    {
        return Product::destroy($id);
    }
}
