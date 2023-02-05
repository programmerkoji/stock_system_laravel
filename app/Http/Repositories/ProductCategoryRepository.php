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

    /**
     * @param array $data
     */
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

    /**
     * @param int $id
     */
    public function findById(int $id)
    {
        return $this->productCategory->find($id);
    }

    /**
     * @param array $data
     * @param int $id
     */
    public function update(array $data, int $id)
    {
        try {
            DB::beginTransaction();
            $this->findById($id)
                ->fill($data)
                ->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();
            $this->findById($id)
                ->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
