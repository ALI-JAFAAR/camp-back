<?php

namespace App\Http\Controllers;

use App\Models\RoomsContents;
use Illuminate\Http\Request;

class RoomsContentsController extends Controller{
    
    /**
     * Display a listing of the resource.
     */
    public function index(){
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $validated = $request->validate([
            'contractor_name' => 'required|string',
            'location' => 'required|string',
            'contractor_confirmation' => 'required|string',
            'housing_type' => 'required|string',
            'phone' => 'required|string',
            'nationality' => 'required|string',
            'work_location' => 'required|string',
            'duration' => 'required|string',
            'contract_number' => 'required|string',
            'room_number' => 'required|string',
            'workers' => 'required|array',
            'workers.*.name' => 'required|string',
        ]);

        // Create the Contractor
        $contractor = Contractor::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomsContents $roomscontents){
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomsContents $roomscontents){
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomsContents $roomscontents){
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomsContents $roomscontents){
        
    }
}
