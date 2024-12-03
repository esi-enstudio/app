<?php

namespace App\Http\Controllers;

use App\Models\DdHouse;
use App\Models\Lifting;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class LiftingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('Service/Lifting/Index', [
            'liftings' => Lifting::with('house')->get(),
            'products' => Product::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Service/Lifting/Create', [
            'houses' => DdHouse::all(['id','code','name']),
            'products' => Product::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'dd_house_id' => 'required',
            'products' => 'required|array',
            'deposit' => 'required|numeric',
            'itopup' => 'nullable',
            'attempt' => 'required',
        ]);

        $validated['itopup'] = round(($validated['deposit'] - array_reduce($validated['products'], function ($carry, $product) {
                    return $carry + ($product['lifting_price'] * $product['quantity']);
                }, 0)) / 0.9625);

        $validated['user_id'] = Auth::id();

        Lifting::create($validated);

        return redirect()->back()->with('success', 'Lifting data added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lifting $lifting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lifting $lifting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLiftingRequest $request, Lifting $lifting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lifting $lifting)
    {
        //
    }
}
