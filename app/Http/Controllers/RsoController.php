<?php

namespace App\Http\Controllers;

use App\Http\Resources\RsoResource;
use App\Models\DdHouse;
use App\Models\Rso;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class RsoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        return inertia('Rso/Index', [
            'rsos' => RsoResource::collection(Rso::search($request->search)
                ->latest()
                ->paginate(5)
                ->onEachSide(0)
                ->withQueryString()),

            'searchTerm' => $request->search,
            'status' => session('msg'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response|ResponseFactory
    {
        $hasUserId = Rso::whereNotNull('user_id')->pluck('user_id');

        $users = User::where('role', 'rso')->whereNotIn('id', $hasUserId)->get();
        $zms = User::where('role', 'zm')->get();
        $managers = User::where('role', 'manager')->get();
        $supervisors = User::where('role', 'supervisor')->get();

        return inertia('Rso/Create', [
            'ddHouses' => DdHouse::all(),
            'users' => $users,
            'zms' => $zms,
            'managers' => $managers,
            'supervisors' => $supervisors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'dd_house_id' => ['required'],
            'user_id' => ['required'],
            'zm_number' => ['required'],
            'manager_number' => ['required'],
            'supervisor_number' => ['required'],
            'osrm_code' => ['nullable'],
            'employee_code' => ['nullable'],
            'code' => ['nullable'],

        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rso $rso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rso $rso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rso $rso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rso $rso)
    {
        //
    }
}
