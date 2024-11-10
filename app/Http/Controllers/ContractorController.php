<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Models\Worker;
use Illuminate\Http\Request;

class ContractorController extends Controller{
    
    public function index(){
        return [
            "success"=>true,
            "data"=>Contractor::with('workers')->get()
        ];
    }

    public function view($id){
        return [
            "success" => true,
            "data" => Contractor::with(['workers', 'room'])->findOrFail($id)
        ];
    }

    public function store(Request $request){
        // Validate the incoming request
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

        // Create Workers
        foreach ($request->workers as $workerData) {
            $contractor->workers()->create($workerData);
        }

        return [
            'message' => 'Contractor and workers added successfully!',
            'contractor' => $contractor,
            'workers' => $contractor->workers,
        ];
    }

}
