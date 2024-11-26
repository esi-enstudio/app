<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommissionResource;
use App\Models\Commission;
use App\Http\Requests\StoreCommissionRequest;
use App\Http\Requests\UpdateCommissionRequest;
use App\Models\DdHouse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Termwind\Components\Dd;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Service/Commission/Index', [
            'commissions' => CommissionResource::collection(Commission::search($request->search)
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
    public function create(): Response
    {
        return Inertia::render('Service/Commission/Create', [
            'houses' => DdHouse::all(['id', 'name', 'code']),
            'status' => session('msg'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'dd_house_id'   => ['required'],
            'manager'       => ['nullable'],
            'supervisor'    => ['nullable'],
            'rso_id'        => ['nullable'],
            'retailer_id'   => ['nullable'],
            'for'           => ['required'],
            'type'          => ['required'],
            'name'          => ['required'],
            'month'         => ['required'],
            'amount'        => ['required'],
            'receive_date'  => ['required'],
            'description'   => ['nullable'],
            'remarks'       => ['nullable'],
        ]);
//        dd($attributes);

        Commission::create($attributes);

        return to_route('commission.create')->with('msg', 'Commission added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Commission $commission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commission $commission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommissionRequest $request, Commission $commission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commission $commission)
    {
        //
    }
}
