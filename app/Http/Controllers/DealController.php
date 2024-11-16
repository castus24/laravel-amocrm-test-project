<?php

namespace App\Http\Controllers;

use App\Services\AmoCrmApiService;

class DealController extends Controller
{
    protected AmoCrmApiService $service;

    public function __construct(AmoCrmApiService $service)
    {
        $this->service = $service;
    }

    public function getDeals()
    {
        return $this->service->getAmoDeals();
    }
}

