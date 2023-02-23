<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\ProductCategoryRepository;
use App\Http\Requests\ProductCategoryRequest;

class ProductCategoryController extends Controller
{
    /**
     * @var ProductCategoryRepository
     */
    protected $productCategoryRepository;

    /**
     * @param ProductCategoryRepository
     */
    public function __construct(ProductCategoryRepository $productCategoryRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
    }

    public function index()
    {
        return $this->productCategoryRepository->index();
    }

    /**
     * @param ProductCategoryRequest $request
     */
    public function store(ProductCategoryRequest $request)
    {
        $this->productCategoryRepository->store($request->toArray());
    }

    /**
     * @param ProductCategoryRequest $request
     * @param int $id
     */
    public function update(ProductCategoryRequest $request, int $id)
    {
        $this->productCategoryRepository->update($request->toArray(), $id);
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        $this->productCategoryRepository->destroy($id);
    }
}
