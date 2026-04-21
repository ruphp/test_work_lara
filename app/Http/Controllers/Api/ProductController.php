<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductIndexRequest;
use App\Http\Resources\ProductResource;
use App\Queries\Products\ProductIndexQuery;

class ProductController extends Controller
{
    public function index(ProductIndexRequest $request, ProductIndexQuery $products)
    {
        $perPage = (int) $request->integer('per_page', 15);

        return ProductResource::collection(
            $products->build($request->validated())->paginate($perPage)->withQueryString()
        );
    }
}
