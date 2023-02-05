<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\ProductCategoryRepository;

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
     * @param Request $request
     */
    public function store(Request $request)
    {
        $this->productCategoryRepository->store($request->toArray());
    }
}
