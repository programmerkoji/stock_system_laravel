<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\StockRepository;

class StockController extends Controller
{
    /**
     * @var StockRepository
     */
    protected $stockRepository;

    /**
     * @param StockRepository
     */
    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    /**
     * @param Request $request
     * @param int $product_id
     */
    public function index(Request $request, int $product_id)
    {
        $this->stockRepository->index($request->toArray(), $product_id);
    }

}
