<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\ProductRepository;

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
     * @param Request $request
     */
    public function store(Request $request)
    {
        return $this->productRepository->store($request->toArray());
    }

    /**
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, int $id)
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
