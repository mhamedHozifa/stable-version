<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- أضف هذا السطر
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // <-- أضف هذا السطر داخل الكلاس

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'image',
        'is_featured'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}