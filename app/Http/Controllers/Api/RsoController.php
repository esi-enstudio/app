<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RsoResource;
use App\Models\Rso;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RsoController extends Controller
{
    public function __invoke(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'dd_house_id' => ['required', 'exists:ddHouses,id']
        ]);

        $rsos = Rso::where('dd_house_id', $request->dd_house_id)->get();

        return RsoResource::collection($rsos);
    }
}
