<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
        protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    // علاقة مع المنتجات: تصنيف واحد يمتلك عدة منتجات
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
