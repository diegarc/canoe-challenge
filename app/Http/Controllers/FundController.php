<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FundsService;

class FundController extends Controller
{
    public function index(Request $request, FundsService $fundsService)
    {
        return $fundsService->list($request->query());
    }
}
