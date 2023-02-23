<?php

namespace App\Http\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * @param Product
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * 全カテゴリ取得
     * @return
     */
    public function index()
    {
        return $this->product->get();
    }

    /**
     * @param array $data
     */
    public function store(array $data)
    {
        $product = new Product;
        try {
            DB::beginTransaction();
            $product->fill($data)->save();
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
        return $this->product->find($id);
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
