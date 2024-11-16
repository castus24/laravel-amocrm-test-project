<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AmoCrmApiService
{
    public function getAmoDeals()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AMOCRM_ACCESS_TOKEN'),
        ])->get($this->getApiBaseUrl() . '/api/v4/leads');

        return $response->json();
    }

    public function bindAmoContact(Request $request, $dealId)
    {
        $response = Http::post($this->getApiBaseUrl() . '/api/v4/contacts', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('AMOCRM_ACCESS_TOKEN'),
            ],
            'json' => [
                'name' => $request->name,
                'phone' => [
                    ['value' => $request->phone, 'enum' => 'WORK']
                ],
                'notes' => [
                    ['text' => $request->comment, 'type' => 'common']
                ],
            ]
        ]);

        $contact = $response->json(); //todo

        $contact = json_decode($contact);

        Http::post($this->getApiBaseUrl() . '/api/v4/leads/' . $dealId . '/contacts', [
            'headers' => [
                'Authorization' => 'Bearer ' . env('AMOCRM_ACCESS_TOKEN'),
            ],
            'json' => [
                'contacts' => [
                    ['id' => $contact->id]
                ]
            ]
        ]);

        Log::info('Контакт привязан к сделке ' . $dealId);

        return response()->json(['message' => 'Контакт привязан успешно']);
    }

    public function getAccessToken($code) //todo
    {
        $response = Http::post($this->getApiBaseUrl() . '/oauth2/access_token', [
            'client_id' => env('AMOCRM_CLIENT_ID'),
            'client_secret' => env('AMOCRM_CLIENT_SECRET'),
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => env('AMOCRM_REDIRECT_URI'),
        ]);

        if ($response->successful()) {
            $tokens = $response->json();
            // Сохраняем токены в .env, базу данных или конфигурацию
            return $tokens;
        }

        throw new \Exception('Failed to get access token: ' . $response->body());
    }

    private function getApiBaseUrl(): string
    {
        return config('app.amo_crm_api.base_url');
    }
}
