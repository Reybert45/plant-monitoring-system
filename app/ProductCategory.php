<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';

    protected $fillable = ['name', 'description'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function product_sub_categories()
    {
        return $this->hasMany(ProductSubCategory::class);
    }
}
