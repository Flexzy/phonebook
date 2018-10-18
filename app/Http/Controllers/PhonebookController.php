<?php

namespace App\Http\Controllers;

use App\Phonebook;
use App\Http\Requests\PhonebookRequest;
use Illuminate\Http\Request;

class PhonebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('phonebook');
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
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:phonebooks',
            'phone' => 'required|numeric',
        ]);

        $phoneRequest = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        $phonebook = Phonebook::create($phoneRequest);  
        return $phonebook;      
    }

    public function getData() {
        return Phonebook::orderBy('name', 'ASC')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function show(Phonebook $phonebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Phonebook $phonebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:phonebooks,email,'.$id,
            'phone' => 'required|numeric',
        ]);

        $phonebook = Phonebook::find($id);
        $phonebook->name = $request->name;
        $phonebook->email = $request->email;
        $phonebook->phone = $request->phone;
        $phonebook->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $phonebook = Phonebook::find($id);
        $phonebook->delete();

        return 'Contact successfully deleted';
    }
}
