<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $contacts = $this->_prepare_contacts();
        return view('contacts.index', ['contacts' => $contacts]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $form_array = array(
            'action' => 'ContactsController@store',
            'method' => 'POST',
            'class' => 'formCreate',
            'label' => 'Create'
        );

        return view('contacts.form', [
            'form_array' => $form_array
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'first_name' => 'required|min:3|max:25',
            'last_name' => 'required|min:3|max:25',
            'number' => 'required|min:3|max:25',
        ]);

        $contact = new Contact();
        $contact->first_name = strval($request->input('first_name'));
        $contact->last_name = strval($request->input('last_name'));
        $contact->number = intval($request->input('number'));
        $contact->save();
        
        $contacts = $this->_prepare_contacts();
        return view('contacts.index', ['contacts' => $contacts]);      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $contact = Contact::findOrFail($id);   
        $form_array = array(
            'action' => 'ContactsController@update',
            'method' => 'PUT',
            'class' => 'formEdit',
            'label' => 'Update'
        );     
        
        return view('contacts.form', [
            'contact' => $contact,
            'form_array' => $form_array
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $request->validate([
            'first_name' => 'required|min:3|max:25',
            'last_name' => 'required|min:3|max:25',
            'number' => 'required|min:3|max:25',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->first_name = strval($request->input('first_name'));
        $contact->last_name = strval($request->input('last_name'));
        $contact->number = intval($request->input('number'));
        $contact->save();
        
        $contacts = $this->_prepare_contacts();
        return view('contacts.index', ['contacts' => $contacts]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        $contacts = $this->_prepare_contacts();
        return view('contacts.index', ['contacts' => $contacts]);
    }

    /**
     * 
     */
    private function _prepare_contacts() {
        $contacts = Contact::orderBy('updated_at', 'desc')->paginate(5);        
        return $contacts;
    }
}
