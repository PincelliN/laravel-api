<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    public function works(){
        return $this->hasMany(Work::class);
    }

    protected $fillable=['name','slug'];
}