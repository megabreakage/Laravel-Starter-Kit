<?php

namespace App\Http\Controllers;

use App\Http\Requests\Country\UpdateCountryRequest;
use App\Models\Country;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->view('', [
            'countries' => Country::all()
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
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country, $id)
    {
        try {
            $country = $country->where('identifier', $id)->first();

            if(!$country){
                // API response
                if($request->is('api/*')) return $this->error('', 'Update failed, try again.', 'Record not found', 404);
                // Webview Response
                return redirect(RouteServiceProvider::DASHBOARD);
            }

            $country = $country->update($request->user()->fill($request->validated()));

            // API response
            if ($request->is('api/*')) {
                return $this->success([
                    'country' => $country,
                    ], 
                    $country ? 'Country Added successfully' : 'Adding the Country failed, try again later.',
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
    public function destroy(Country $country)
    {
        //
    }
}
