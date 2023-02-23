<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\StockRepository;
use App\Http\Services\StockService;
use App\Http\Requests\StockRequest;

class StockController extends Controller
{
    /**
     * @var StockRepository
     */
    protected $stockRepository;

    /**
     * @var StockService
     */
    protected $stockService;

    /**
     * @param StockRepository
     * @param StockService
     */
    public function __construct(StockRepository $stockRepository, StockService $stockService)
    {
        $this->stockRepository = $stockRepository;
        $this->stockService = $stockService;
    }

    /**
     * @param int $product_id
     */
    public function index(int $product_id)
    {
        return $this->stockRepository->index($product_id);
    }

    /**
     * @param StockRequest $request
     */
    public function store(StockRequest $request)
    {
        $this->stockRepository->store($request->toArray());
    }

    /**
     * @param StockRequest $request, $id
     */
    public function update(StockRequest $request, int $id)
    {
        $this->stockRepository->update($request->toArray(), $id);
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        $this->stockRepository->destroy($id);
    }

    /**
     * @param
     */
    public function countArrivedAllocation()
    {
        return $this->stockRepository->countArrivedAllocation();
    }

    /**
     *  @param int $product_category_id
     */
    public function summary(int $product_category_id)
    {
        return $this->stockService->summary($product_category_id);
    }

    /**
     * @param int $product_id
     */
    public function summaryByProduct(int $product_id)
    {
        return $this->stockService->summaryByProduct($product_id);
    }

    /**
     * @param int $product_id
     */
    public function total(int $product_id)
    {
        return $this->stockService->total($product_id);
    }
}
