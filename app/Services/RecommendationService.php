<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Http;

class RecommendationService
{
    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getSalesData()
    {
        return $this->orderRepository->getSalesData();
    }

    public function getAIRecommendations($salesData): array|string
    {
        $apiKey = config('api_keys.gemini');
        $prompt = "Given this sales data, which products should we promote for higher revenue? " . json_encode($salesData);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt]
                    ]
                ]
            ]
        ]);

        if ($response->failed()) {
            return [
                'error' => 'AI API call failed',
                'details' => $response->body()
            ];
        }

        return $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'No response';
    }
}
