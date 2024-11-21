<?php

namespace App\Http\Controllers;

use App\Http\Resources\RetailerResource;
use App\Models\Retailer;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class RetailerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        return inertia('Retailer/Index', [
            'retailers' => RetailerResource::collection(Retailer::search($request->search)
                ->latest('enabled')
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Retailer $retailer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Retailer $retailer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Retailer $retailer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Retailer $retailer)
    {
        //
    }
}
