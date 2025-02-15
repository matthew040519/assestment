<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    //
    protected $table = 'products';
    protected $fillable = ['image', 'name', 'description', 'price', 'category_id', 'stock'];

    public function category()
    {
        return $this->hasOne(category::class, 'id', 'category_id');
    }

    public function tags()
    {
        return $this->hasMany(tags::class, 'product_id', 'id');
    }
}
