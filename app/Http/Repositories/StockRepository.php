<?php

namespace App\Http\Repositories;

use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class StockRepository
{
    /**
     * @var Stock
     */
    protected $stock;

    /**
     * @param Stock
     */
    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    /**
     * @param array $data
     * @param int $product_id
     */
    public function index(array $data, int $product_id)
    {
        $query = $this->stock
            ->with(['product'])
            ->where(['product_id', $product_id]);
        if (isset($data['condition'])) {
            $query->where(['condition', $data['condition']]);
        }
        return $query->get();
    }
}
