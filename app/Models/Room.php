<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model{
    use HasFactory;
    protected $guarded = ["id"];

    public function contents(){
        return $this->belongsToMany(Content::class, 'room_contents')
                    ->withPivot('count');
    }

    
}
