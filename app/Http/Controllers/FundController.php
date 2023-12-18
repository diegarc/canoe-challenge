<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FundsService;
use App\Models\Fund;

class FundController extends Controller
{
    public function index(Request $request, FundsService $fundsService)
    {
        return $fundsService->list($request->query());
    }

    public function update(Request $request, Fund $fund, FundsService $fundsService)
    {
        return $fundsService->update($fund, $request->all());
    }

    public function store(Request $request, FundsService $fundsService)
    {
        return $fundsService->create($request->all());
    }
}
