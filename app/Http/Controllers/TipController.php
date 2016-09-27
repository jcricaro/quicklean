<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tip;
use App\Http\Requests\Tip\AddTipRequest;

class TipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tip $tip)
    {
        return view('tips.list')->with('tips', $tip->all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tips.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddTipRequest $request, Tip $tip)
    {
        $tip->create($request->only(['title', 'content']));

        return redirect()->to('/tips')->with('success', 'Tip created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tip $tip)
    {
        return view('tips.edit')->with('tip', $tip);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tip $tip)
    {
        $tip->fill($request->only(['title', 'content']));
        $tip->save();
        
        return redirect()->to('/tips')->with('success', 'Tip updated');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tip $tip)
    {
        $tip->delete();

        return redirect('/tips')->with('success', 'Tip deleted');
    }
}
