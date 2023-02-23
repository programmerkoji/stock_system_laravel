<?php

namespace App\Http\Repositories;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StockRepository
{
    const NOT_IN_STOCK = 1;
    const ARRIVED = [2, 4];
    const SHIPPED = 5;

    /**
     * @var Stock
     */
    protected $stock;

    /**
     * @var Product
     */
    protected $product;

    /**
     * @param Stock
     * @param Product
     */
    public function __construct(Stock $stock, Product $product)
    {
        $this->stock = $stock;
        $this->product = $product;
    }

    /**
     * @param int $product_id
     */
    public function index(int $product_id)
    {
        return $this->stock
            ->with(['product'])
            ->where('product_id', $product_id)
            ->get();
    }

    /**
     * @param array $data
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();
            $quantity = $data['quantity'];
            for ($i = 0; $i < (int)$quantity; $i++) {
                $stock = new Stock;
                $stock->fill($data)->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollback();
        }
    }

    /**
     * @param $id
     */
    public function findById(int $id)
    {
        return $this->stock->find($id);
    }

    /**
     * 在庫編集
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
            Log::error($th);
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
            Log::error($th);
            DB::rollback();
        }
    }

    /**
     * @param int $product_category_id
     */
    public function getProductCategory($product_category_id)
    {
        return $this->product->where('product_category_id', $product_category_id);
    }

    /**
     * @param int $product_id
     */
    public function getProduct($product_id)
    {
        return $this->product->where('id', $product_id);
    }

    /**
     * @param int $product_id
     */
    public function getProductId(int $product_id)
    {
        return $this->stock->where('product_id', $product_id);
    }

    /**
     * 入荷済、引当
     * @param int $id
     */
    public function getArrivedAllocation(int $id)
    {
        return $this->getProductId($id)
            ->whereBetween('condition', self::ARRIVED)
            ->where('condition', '!=', self::SHIPPED)
            ->whereNotNull('assign_id');
    }

    /**
     * 入荷済み、未引当
     * @param int $id
     */
    public function getArrivedUnallocation(int $id)
    {
        return $this->getProductId($id)
            ->whereBetween('condition', self::ARRIVED)
            ->where('condition', '!=', self::SHIPPED)
            ->whereNull('assign_id');
    }

    /**
     * 入荷予定、引当
     * @param int $id
     */
    public function getNotInStockAllocation(int $id)
    {
        return $this->getProductId($id)
            ->where('condition', self::NOT_IN_STOCK)
            ->where('condition', '!=', self::SHIPPED)
            ->whereNotNull('assign_id');
    }

    /**
     * 入荷予定、未引当
     * @param int $id
     */
    public function getNotInStockUnallocation(int $id)
    {
        return $this->getProductId($id)
            ->where('condition', self::NOT_IN_STOCK)
            ->where('condition', '!=', self::SHIPPED)
            ->whereNull('assign_id');
    }

    /**
     * 出荷済み以外の在庫取得
     * @param int $product_id
     */
    public function getStocks(int $product_id)
    {
        return $this->getProductId($product_id)->where('condition', '!=', self::SHIPPED);
    }
    /**
     * @param int $product_id
     */
    public function getProductPrice(int $product_id)
    {
        return $this->product->where('id', $product_id)->pluck('price');
    }
}
