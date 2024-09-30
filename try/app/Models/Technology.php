<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

     public function works(){
        return $this->belongsToMany(Work::class);
    }
   protected $fillable=['name','slug'];
}