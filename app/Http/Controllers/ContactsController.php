<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contacts\StoreContactRequest;
use App\Http\Requests\Contacts\UpdateContactRequest;
use App\Models\Contact;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactsController extends Controller
{

    public $data;
    public $message;
    public $errors;
    public $code;

    public function index(){
        return response()->view('dashboard.contacts', [
            'contacts' => Contact::all()
        ]);
    }

    public function store(StoreContactRequest $request)
    {
        try {
            $request->validated($request->all());

            $record = Contact::create([
                'identifier' => generate_identifier(),
                'name' => $request->name,
                'contact_type_id' => $request->contact_type_id,
                'value' => $request->value,
                'added_by' => Auth::id(),
                'activated_by' => Auth::id(),
                'activated_at' => Carbon::now(),
            ]);

            if(!$record) throw new Exception('Creating new contact failed, Try again later.', 400);
            $this->data = $record;
            $this->message = 'Contact was added successfully'; 
        } catch (\Throwable $th) {
            $this->errors = $th;
            $this->message = $th->getMessage();
        } finally{
            return redirect('dashboard.contacts', [
                'errors' => $this->errors,
                'message' => $this->message,
                'data' => $this->data
            ]);
        }
    }

    public function update(UpdateContactRequest $request, Contact $contact, $id){
        try {
            $contact = $contact->find($id);
            if(!$contact){
                throw new Exception('Record not found', 404);
            }else{
                $contact->update($request->user()->fill($request->all()));
                if(!$contact){
                    throw new Exception('Record updating failed, Try again later' ,400);
                }
                $this->data = $contact->find($id);
                $this->message = 'Contact updated successfully';
            }
        } catch (\Throwable $th) {
            $this->errors = $th;
            $this->message = $th->getMessage();
        } finally{
            return redirect('dashboard.contacts', [
                'errors'=> $this->errors,
                'message' => $this->message
            ]);

        }
    }
}
