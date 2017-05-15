<?php

namespace App\Http\Controllers;

use App\models\Nerd;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\InputInterface;

class NerdController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all the nerds
        $nerds = Nerd::all();

        // load the view and pass the nerds
        return view('nerds.index')
            ->with('nerds', $nerds);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('nerds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(\Illuminate\Http\Request $request)
    {
        dd($request);
        //validador
        $rules = array(
            'name'          => 'required',
            'email'         => 'required|email',
            'nerd_level'    => 'required|numeric'
        );
        $validator = Validator::make(Input::all(), $rules);

        //login
        if($validator->fails()){
            return Redirect::to('nerds/create')
                ->withErrors($validator)
                ->withInput(Input::except ('password'));
        }else {
            $nerd = new Nerd;
            $nerd->name            = Input::get('name');
            $nerd->email           = Input::get('email');
            $nerd->nerd_level      = Input::get('nerd_level');
            $nerd->save();


            //redirect
            Session::flash('message', 'Sucessfully created nerd!');
            return Redirect::to('nerds');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // get nerd
        $nerd = Nerd::find($id);


        return view('nerds.show')
            ->with('nerd', $nerd);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
