<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rso;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class SupervisorController extends Controller
{
    public function __invoke($id): JsonResponse
    {
        $supervisorId =  Rso::where('dd_house_id', $id)->pluck('supervisor')->unique();
        $supervisors = User::whereIn('id', $supervisorId)->get();

        return response()->json($supervisors);
    }
}
