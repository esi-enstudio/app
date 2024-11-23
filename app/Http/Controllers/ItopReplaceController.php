<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItopReplaceResource;
use App\Models\ItopReplace;
use App\Http\Requests\StoreItopReplaceRequest;
use App\Http\Requests\UpdateItopReplaceRequest;
use App\Models\Retailer;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\ResponseFactory;

class ItopReplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        return inertia('Service/ItopReplace/Index', [
            'itopReplaces' => ItopReplaceResource::collection(ItopReplace::search($request->search)
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
        return Inertia::render('Service/ItopReplace/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'number'        => ['required','numeric','digits:11'],
            'sim_serial'    => ['required','numeric','digits:18','unique:itop_replaces,sim_serial'],
            'balance'       => ['required','numeric'],
            'reason'        => ['required','max:100'],
            'remarks'       => ['nullable','max:100'],
            'description'   => ['nullable','max:255'],
        ]);

        $attributes['retailer_id'] = Retailer::firstWhere('number', $request->number)->id;
        $attributes['rso_id'] = Retailer::firstWhere('number', $request->number)->rso_id;
        $attributes['supervisor'] = Retailer::firstWhere('number', $request->number)->supervisor;
        $attributes['manager'] = Retailer::firstWhere('number', $request->number)->manager;
        $attributes['zm'] = Retailer::firstWhere('number', $request->number)->zm;
        $attributes['user_id'] = Retailer::firstWhere('number', $request->number)->user_id;
        $attributes['dd_house_id'] = Retailer::firstWhere('number', $request->number)->dd_house_id;

        ItopReplace::create($attributes);

        return to_route('itopReplace.index')->with('msg', 'Itop replace request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ItopReplace $itopReplace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItopReplace $itopReplace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItopReplaceRequest $request, ItopReplace $itopReplace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItopReplace $itopReplace)
    {
        //
    }
}
