<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{
    Http\Requests\Machine\AddMachineRequest,
    Http\Requests,
    Machine
};

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Machine $machine)
    {
        $machines = $machine->orderBy('id', 'desc')->paginate();

        return view('machines.list')->with('machines', $machines);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Machine\AddMachineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddMachineRequest $request, Machine $machine)
    {
        $machine->create($request->only(['name', 'type']));

        $request->session()->flash('success', 'Machine created!');

        return redirect('/machines');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
