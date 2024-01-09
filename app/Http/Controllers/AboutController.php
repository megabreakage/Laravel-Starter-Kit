<?php

namespace App\Http\Controllers;

use App\Http\Requests\About\AddAboutRequest;
use App\Http\Requests\About\UpdateAboutRequest;
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

    public function store(AddAboutRequest $request){
        
        try {
            $request->validated($request->all());

            About::create([
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
        } finally{
            // return redirect('dashboard.about', ['errors'=> $this->errors]);
        }
    }

    public function update(UpdateAboutRequest $request, About $about, $id){
        try {
            $about = $about->find($id);
            if(!$about){
                throw new Exception("About record not found", 404);
            }else{
                $response = $about->update($request->user()->fill($request->validated()));
                if(!$response){
                    throw new Exception("Record not updated", 400);
                }
            }
        } catch (\Throwable $th) {
            $this->errors = $th;
        } finally{
            return redirect('dashboard.about', ['errors' => $this->errors]);
        }
    }
}
