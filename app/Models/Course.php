<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [

    'category_id',

    'title',

    'description',

    'price',

    'status',

    'image'

];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}