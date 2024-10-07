<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function  type()
    {
        return $this->belongsTo(Type::class);
    }
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
    protected $fillable = [
        'title',
        'type_id',
        'path_img',
        'original_name_img',
        'slug',
        'subject',
        'start_date',
        'end_date',
        'post',
        'collaborators',
        'description',

    ];
}
