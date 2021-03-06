<?php

namespace App\Http\Controllers;

use Validator;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

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
        // return ($request);

        // Handle File Upload
        if($request->hasFile('image')) {
            // dd('testing ');
            // Get filename with extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
           // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
          // Upload Image
            $contact = $request->file('image')->storeAs('/public/images', $fileNameToStore);
        } else {
            // dd('testing for no image');
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Contact
        $contact = new Contact;

        $contact->name = $request->input('name');
        $contact->position = $request->input('position');
        $contact->phone = $request->input('phone');
        $contact->image = $fileNameToStore;
        // $contact->image = $request->file('image')->store('images');

        $contact->save();

        return redirect('/contacts');

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
        return view('contacts.edit', compact('contacts'));
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

        $contact = Contact::find($contact->id);
        $contact->name = $request->input('name');
        $contact->position = $request->input('position');
        $contact->phone = $request->input('phone');

        // return ($request);

        // Handle File Upload
        if($request->hasFile('image')) {
            // dd('testing ');
            // Get filename with extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
           // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
          // Upload Image
            $contact = $request->file('image')->storeAs('/public/images', $fileNameToStore);
        } else {
            // dd('testing for no image');
            $fileNameToStore = 'noimage.jpg';
        }

        $contact->update(request(['name', 'position', 'phone']));

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

        if($contact->image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/images/'.$contact->image);
        }

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
        // return view('contacts.search', ['contacts' => $contacts]);
        return view('contacts.search', compact('contacts'));
    }
}
