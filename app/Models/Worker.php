<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model{
    
    use HasFactory;

    protected $fillable = [
        'name',
        'contractor_id',
    ];

    public function contractor(){
        return $this->belongsTo(Contractor::class);
    }

}
