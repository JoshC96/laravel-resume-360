<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorepromptRequest;
use App\Http\Requests\UpdatepromptRequest;
use App\Models\prompt;

class PromptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepromptRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(prompt $prompt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(prompt $prompt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepromptRequest $request, prompt $prompt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(prompt $prompt)
    {
        //
    }
}
