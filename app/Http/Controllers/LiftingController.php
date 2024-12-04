<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateLiftingRequest;
use App\Models\DdHouse;
use App\Models\Lifting;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

class LiftingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response|ResponseFactory
    {
        return inertia('Service/Lifting/Index', [
            'liftings' => Lifting::latest()->paginate(5),
            'products' => Product::all(),
            'status' => session('msg'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Service/Lifting/Create', [
            'houses' => DdHouse::all(['id','code','name']),
            'products' => Product::all(),
            'status' => session('msg'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'dd_house_id'   => ['required'],
            'products'      => ['required','array'],
            'deposit'       => ['required','numeric','min:1'],
            'itopup'        => ['nullable'],
            'attempt'       => ['required'],
        ],[

        ],[
            'dd_house_id' => 'house'
        ]);

        $validated['itopup'] = round(($validated['deposit'] - array_reduce($validated['products'], function ($carry, $product) {
                    return $carry + ($product['lifting_price'] * $product['quantity']);
                }, 0)) / 0.9625);

        $validated['user_id'] = Auth::id();

        Lifting::create($validated);

        return to_route('lifting.create')->with('msg', 'Lifting data added successfully!');
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
    public function edit(Lifting $lifting): Response
    {
        return Inertia::render('Service/Lifting/Edit', [
            'lifting' => $lifting,
            'houses' => DdHouse::all(),
            'products' => Product::all(), // Pass products for dropdowns
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLiftingRequest $request, Lifting $lifting): RedirectResponse
    {
        $attributes = $request->validated();

        $attributes['itopup'] = round(
            ($attributes['deposit'] - array_reduce($attributes['products'], function ($carry, $product)
                {
                    return $carry + ($product['lifting_price'] * $product['quantity']);
                }, 0)) / 0.9625
        );

        $attributes['user_id'] = Auth::id();

        $lifting->update($attributes);

        return to_route('lifting.index')->with('msg', 'Lifting data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lifting $lifting): RedirectResponse
    {
        $lifting->delete();

        return to_route('lifting.index')->with('msg', 'Lifting data deleted successfully!');
    }
}
