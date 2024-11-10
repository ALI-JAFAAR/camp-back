<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model{
    
    use HasFactory;

    protected $fillable = [
        'contractor_name',
        'location',
        'contractor_confirmation',
        'housing_type',
        'phone',
        'nationality',
        'work_location',
        'duration',
        'contract_number',
        'room_number',
    ];

    public function workers(){
        return $this->hasMany(Worker::class);
    }

    public function room(){
        return $this->belongsTo(Room::class,'room_number'); // Assuming room_id is the foreign key in Contractor table
    }
    
}
