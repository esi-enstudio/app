<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\RetailerResource;
use App\Models\Retailer;
use Illuminate\Http\JsonResponse;

class RetailerController extends Controller
{
    public function __invoke($id): JsonResponse
    {
        $retailers =  Retailer::where([
            ['dd_house_id', $id],
            ['enabled', 1]
        ])->get();

        return response()->json(RetailerResource::collection($retailers));
    }
}
