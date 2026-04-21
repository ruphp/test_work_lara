<?php

namespace App\Queries\Products;

use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ProductIndexQuery
{
    /**
     * @param  array<string, mixed>  $filters
     * @return Builder<Product>
     */
    public function build(array $filters): Builder
    {
        $query = Product::query()->with('category');

        $query->when($filters['q'] ?? null, fn (Builder $query, string $q) => $query->where('name', 'like', "%{$q}%"));

        if (array_key_exists('price_from', $filters)) {
            $query->where('price', '>=', $filters['price_from']);
        }

        if (array_key_exists('price_to', $filters)) {
            $query->where('price', '<=', $filters['price_to']);
        }

        if (array_key_exists('category_id', $filters)) {
            $query->where('category_id', $filters['category_id']);
        }

        if (array_key_exists('in_stock', $filters)) {
            $query->where('in_stock', $filters['in_stock']);
        }

        if (array_key_exists('rating_from', $filters)) {
            $query->where('rating', '>=', $filters['rating_from']);
        }

        return $this->applySort($query, $filters['sort'] ?? null);
    }

    /**
     * @param  Builder<Product>  $query
     * @return Builder<Product>
     */
    private function applySort(Builder $query, ?string $sort): Builder
    {
        return match ($sort) {
            'price_asc' => $query->orderBy('price')->orderBy('id'),
            'price_desc' => $query->orderByDesc('price')->orderBy('id'),
            'rating_desc' => $query->orderByDesc('rating')->orderBy('id'),
            'newest' => $query->orderByDesc('created_at')->orderByDesc('id'),
            default => $query->orderBy('id'),
        };
    }
}
