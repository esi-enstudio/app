<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RsoResource;
use App\Models\Rso;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RsoController extends Controller
{
    public function __invoke(Request $request)
    {
        $rsos =  Rso::where('dd_house_id', $request->id)->get();

        return response()->json(RsoResource::collection($rsos));
    }
}
