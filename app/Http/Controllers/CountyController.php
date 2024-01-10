<?php

namespace App\Http\Controllers;

use App\Http\Requests\County\StoreCountyRequest;
use App\Http\Requests\County\UpdateCountyRequest;
use App\Models\Country;
use App\Models\County;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreCountyRequest $request)
    {
        $request->validated($request->all());
        
        try {
            $country = Country::where('identifier', $request->country_id)->first();

            if(!$country){
                // API response
                if($request->is('api/*')) return $this->error('', 'County addition failed, related country record not found', 404);
                // Webview Response
                return redirect(RouteServiceProvider::DASHBOARD);
            }

            $county = Country::create([
                'identifier' => generate_identifier(),
                'name' => $request->name,
                'shortcode' => $request->shortcode,
                'country_id' => $country->id,
                'active' => true,
                'added_by' => Auth::id(),
                'activated_by' => Auth::id(),
                'activated_at' => Carbon::now(),
            ]);

            // API response
            if ($request->is('api/*')) {
                return $this->success([
                    'county' => $county,
                    ], 
                    $county ? 'County Added successfully' : 'Adding the County failed, try again later.',
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
     * Display the specified resource.
     */
    public function show(County $county)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(County $county)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountyRequest $request, County $county, $id)
    {
        try {
            $county = $county->where('identifier', $id)->first();

            if(!$county){
                // API response
                if($request->is('api/*')) return $this->error('', 'Update failed, try again.', 'Record not found', 404);
                // Webview Response
                return redirect(RouteServiceProvider::DASHBOARD);
            }

            $county = $county->update($request->user()->fill($request->validated()));

            // API response
            if ($request->is('api/*')) {
                return $this->success([
                    'country' => $county,
                    ], 
                    $county ? 'County Added successfully' : 'Adding the County failed, try again later.',
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
    public function destroy(County $county)
    {
        //
    }
}
