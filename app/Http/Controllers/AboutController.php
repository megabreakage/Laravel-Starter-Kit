<?php

namespace App\Http\Controllers;

use App\Models\About;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{

    public $errors = '';
    public $data = '';
    public $message = '';
    public $code = '';
    
    public function index(){
        // return response()->view('dashboard.about', [
        //     'about' => About::all()
        // ]);
    }

    public function store(Request $request){
        $request->validated($request->all());

        try {
            $about = About::create([
                'identifier' => generate_identifier(),
                'name' => $request->name,
                'description' => $request->description,
                'mission' => $request->mission,
                'vision' => $request->vision,
                'core_values' => $request->core_values,
                'added_by' => Auth::id(),
            ]);

            // return redirect('dashboard.about');
        } catch (\Throwable $th) {
            $this->errors = $th->getError;
        }
    }
}
