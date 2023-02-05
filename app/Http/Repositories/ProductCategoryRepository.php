<?php

namespace App\Http\Repositories;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class ProductCategoryRepository
{
    /**
     * @var ProductCategory
     */
    protected $productCategory;

    /**
     * @param ProductCategory
     */
    public function __construct(ProductCategory $productCategory)
    {
        $this->productCategory = $productCategory;
    }

    /**
     * 全カテゴリ取得
     * @return
     */
    public function index()
    {
        return $this->productCategory->get();
    }

    public function store(array $data)
    {
        $productCategory = new ProductCategory;
        try {
            DB::beginTransaction();
            $productCategory->fill($data)->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
