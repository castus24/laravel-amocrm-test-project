<?php

namespace App\Http\Controllers;

use App\Services\AmoCrmApiService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected AmoCrmApiService $service;

    public function __construct(AmoCrmApiService $service)
    {
        $this->service = $service;
    }

    public function bindContact(Request $request, $dealId)
    {
        return $this->service->bindAmoContact($request, $dealId);
    }
}
