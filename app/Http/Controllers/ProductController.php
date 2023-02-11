<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @param ProductRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        return $this->productRepository =$productRepository;
    }

    public function index()
    {
        return $this->productRepository->index();
    }

    /**
     * @param ProductRequest $request
     */
    public function store(ProductRequest $request)
    {
        return $this->productRepository->store($request->toArray());
    }

    /**
     * @param ProductRequest $request
     * @param int $id
     */
    public function update(ProductRequest $request, int $id)
    {
        return $this->productRepository->update($request->toArray(), $id);
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        return $this->productRepository->destroy($id);
    }
}
