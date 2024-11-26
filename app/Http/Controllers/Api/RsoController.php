<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\RsoResource;
use App\Models\Rso;
use Illuminate\Http\JsonResponse;

class RsoController extends Controller
{
    public function __invoke($id): JsonResponse
    {
        $rsos =  Rso::where('dd_house_id', $id)->get();

        return response()->json(RsoResource::collection($rsos));
    }
}
