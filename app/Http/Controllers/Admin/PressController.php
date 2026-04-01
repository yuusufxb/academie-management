<?php namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

class PressController extends Controller {
    public function index() {
        $clippings = collect([]);
        return view('admin.press', compact('clippings'));
    }

    public function create()
    {
        return view('admin.press-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.press-show');
    }

    /**
     * Show the form for editing the specified resource.
     */
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
