<?php

namespace App\Http\Controllers;

use App\Models\Continent;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class ContinentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->view('', [
            'continents' => Continent::all()
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
    public function show(Continent $continent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Continent $continent)
    {
        return response()->view('', [
            'continent' => Continent::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Continent $continent, $id)
    {

        try {
            $continent = $continent->where('identifier', $id)-> first();

            if(!$continent){
                // API response
                if($request->is('api/*')) return $this->error('', 'Update failed, try again.', 'Record not found', 404);
                // Webview Response
                return redirect(RouteServiceProvider::DASHBOARD);
            }

            $continent = Continent::updated($request->user()->fill($request->validated()));

            // API response
            if ($request->is('api/*')) {
                return $this->success([
                    'continent' => $continent,
                    ], 
                    $continent ? 'Continent Added successfully' : 'Adding the Continent failed, try again later.',
                );
            }

            // Webview response
            return redirect(RouteServiceProvider::DASHBOARD);
        } catch (\Throwable $error) {
            // API response
            if($request->is('api/*')) return $this->error('', 'Request processing failed, try again later.', $error, 400);
            // Webview Response
            return redirect(RouteServiceProvider::DASHBOARD);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Continent $continent)
    {
        //
    }
}
