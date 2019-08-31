<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

// use Symfony\Component\Console\Input\Input;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();

        // return $contacts;

        return view ('contacts.index', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'position' => 'required',
            'phone' => 'required',
            // 'picture' => 'required'
        ]);

        $validator->after(function ($validator) use($contact) {
            if($validator->errors()->all()){
                $validator->errors()->add(strval($contact->id), 'Please complete all the sections in this form');
            }
        });

        if ($validator->fails()) {
            return redirect('/contacts')
                        ->withErrors($validator)
                        ->withInput();
        }

        $contact->update(request(['name', 'position', 'phone', 'image']));

        // $user->name = request('name');
        // $user->position = request('position');
        // $user->phone = request('phone');

        // $user->save();

        return redirect('/contacts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect('/contacts');
    }

    public function search(Contact $contact)
    {

        $q = Input::get('query');

        $contacts = Contact::where('name', 'LIKE', '%' . $q . '%')
            ->orWhere('position', 'LIKE', '%' . $q . '%')
            ->orWhere('phone', 'LIKE', '%' . $q . '%')
            ->get();

        // dd($contacts);
        // return $contacts;
        return view('contacts.search', ['contacts' => $contacts]);
        // return view('contacts.search', compact('contacts'));
    }
}
