<?php

namespace App\Http\Controllers;

use App\Services\RecommendationService;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    protected $recommendationService;

    public function __construct(RecommendationService $recommendationService)
    {
        $this->recommendationService = $recommendationService;
    }

    public function getAiRecommendations()
    {
        $salesData = $this->recommendationService->getSalesData();
        $recommendations = $this->recommendationService->getAIRecommendations($salesData);

        if (is_string($recommendations)) {
            $recommendations = explode("\n", $recommendations);
        }

        if (is_array($recommendations) && isset($recommendations['error'])) {
            return back()->withErrors(['error' => $recommendations['error']]);
        }

        return view('admin.recommendations.index', [
            'recommendations' => $recommendations,
            'salesData' => $salesData,
        ]);
    }


    public function index()
    {
        return view('admin.recommendations.index');
    }
}
