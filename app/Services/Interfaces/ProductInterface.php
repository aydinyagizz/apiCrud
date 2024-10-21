<?php

namespace App\Services\Interfaces;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Collection;

interface ProductInterface
{
    /**
     * @return Collection
     */
    public function index(): Collection;

    /**
     * @param int $id
     * @return Product|null
     */
    public function productById(int $id): ?Product;

    /**
     * @param Product $model
     * @return bool
     */
    public function store(Product $model): bool;

    /**
     * @param ProductRequest $request
     * @param int $id
     * @return bool
     */
    public function update(ProductRequest $request, int $id): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
