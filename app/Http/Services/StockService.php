<?php

namespace App\Http\Services;

use App\Http\Repositories\StockRepository;
use App\Http\Repositories\StockProductLogRepository;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;

class StockService
{
    /**
     * @var StockRepository
     */
    protected $stockRepository;

    /**
     * @param StockRepository $stockRepository
     */
    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    /**
     * @param int $product_category_id
     * @return Collection
     */
    public function summary($product_category_id): Collection
    {
        $allProductsData = $this->stockRepository->getProductCategory($product_category_id)->pluck('name', 'id');
        $stats = collect();
        foreach ($allProductsData as $id => $value) {
            $stat = [];

            $stat['product_id'] = $id;
            $stat['product_name'] = $value;
            //入荷済、引当
            $stat['arrivedAllocation'] = $this->stockRepository->getArrivedAllocation($id)->count();
            // 入荷済み、未引当
            $stat['arrivedUnallocation'] = $this->stockRepository->getArrivedUnallocation($id)->count();
            // 入荷予定、引当
            $stat['notInStockAllocation'] = $this->stockRepository->getNotInStockAllocation($id)->count();
            // 入荷予定、未引当
            $stat['notInStockUnallocation'] =  $this->stockRepository->getNotInStockUnallocation($id)->count();

            $stats->push($stat);
        }
        return $stats;
    }

    /**
     * @param int $product_id
     * @return Collection
     */
    public function summaryByProduct(int $product_id)
    {
        $allProductsData = $this->stockRepository->getProduct($product_id)->pluck('name');
        foreach ($allProductsData as $value) {
            $stat = [];

            $stat['product_name'] = $value;
            //入荷済、引当
            $stat['arrivedAllocation'] = $this->stockRepository->getArrivedAllocation($product_id)->count();
            // 入荷済み、未引当
            $stat['arrivedUnallocation'] = $this->stockRepository->getArrivedUnallocation($product_id)->count();
            // 入荷予定、引当
            $stat['notInStockAllocation'] = $this->stockRepository->getNotInStockAllocation($product_id)->count();
            // 入荷予定、未引当
            $stat['notInStockUnallocation'] =  $this->stockRepository->getNotInStockUnallocation($product_id)->count();
        }
        return $stat;
    }

    /**
     * @param int $product_id
     * @return Collection
     */
    public function total(int $product_id): Collection
    {
        $amount = $this->stockRepository->getStocks($product_id)->count();
        $price = $this->stockRepository->getProductPrice($product_id)->first();
        $totalPrice = $amount * $price;
        $total = collect();
        $total['totalAmount'] = $amount;
        $total['totalPrice'] = $totalPrice;
        return $total;
    }
}
