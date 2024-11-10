<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentsController extends Controller{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return Content::all();

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
            'name' => 'required|string',
        ]);
        // Create the Contractor
        $content = Content::create($validated);
        return $content?["success"=>true,'data'=>$content]:["success"=>false,"message"=>"something wrong"];
    }

    /**
     * Display the specified resource.
     */
    public function show(allcontents $allcontents){
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(allcontents $allcontents){
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, allcontents $allcontents){
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(allcontents $allcontents){
        
    }
}
