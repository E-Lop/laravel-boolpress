<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Lead;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactThankYouEmail;

class LeadController extends Controller
{
    public function store(Request $request) {
        $data = $request->all();

        // validazione dei dati
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'message' => 'required|max:60000',
        ]);

        // se la validazione fallisce
        if($validator->fails()) {
            // json restituisce success => false
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        // salvataggio dati in db
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        // invio email automatica di ringraziamento
        Mail::to($data['email'])->send(new ContactThankYouEmail());

        return response()->json([
            'success' => true
        ]);
    }
}
