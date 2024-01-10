<?php

namespace App\Http\Controllers;

use App\Http\Requests\Town\StoreTownRequest;
use App\Http\Requests\Town\UpdateTownRequest;
use App\Models\Country;
use App\Models\Town;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TownController extends Controller
{
    public $data = '';
    public $message =  '';
    public $errors = ''; 
    public $code = '';
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
    public function store(StoreTownRequest $request)
    {
        
        try {
            $request->validated($request->all());

            $county = Country::where('identifier', $request->county_id)->first();

            if(!$county){
                throw new Exception("Related country record not found.");
                $this->code = 404;
            }

            $this->data = Town::create([
                'identifier' => generate_identifier(),
                'name' => $request->name,
                'shortcode' => $request->shortcode,
                'county_id' => $county->id,
                'active' => true,
                'added_by' => Auth::id(),
                'activated_by' => Auth::id(),
                'activated_at' => Carbon::now(),
            ]);
        } catch (\Throwable $e) {
            $this->errors = $e;
        } finally {
            // API response
            if ($request->is('api/*')) {
                if($this->errors) return $this->error('', 'Request processing failed', $this->errors, 400);
                return $this->success(
                    ['town' => $this->data], 
                    $this->errors ? 'Town Added successfully' : 'Town adding failed, try again later.',
                );
            }
            
            // Webview response
            return redirect(RouteServiceProvider::DASHBOARD);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Town $town)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Town $town)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTownRequest $request, Town $town, $id)
    {
        try {
            $town = $town->where('identifier', $id)->first();

            if(!$town){
                throw new Exception("Town record not found.");
                $this->code = 404;
            }

            if($town->update($request->user()->fill($request->validated()))) 
                $this->data = $town->find($town->id); 
        } catch (\Throwable $e) {
            $this->errors = $e;
        } finally {
            // API response
            if ($request->is('api/*')) {
                if($this->errors) return $this->error('', 'Request processing failed, try again later.', $this->errors, 400);
                return $this->success(
                    ['town' => $this->data], 
                    $this->errors ? 'Town Added successfully' : 'Town adding failed, try again later.',
                );
            }
            
            // Webview response
            return redirect(RouteServiceProvider::DASHBOARD);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Town $town)
    {
        //
    }
}

