<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class InitiativeController extends Controller {
    public function index() {
        $initiatives = collect([]);
        return view('admin.initiatives', compact('initiatives'));
    }

    public function create()
    {
        return view('admin.initiative-form');
    }

    public function store(Request $request)
    {

    }
    public function show(string $id)
    {
        return view('admin.initiative-show');
    }
    public function edit(string $id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
