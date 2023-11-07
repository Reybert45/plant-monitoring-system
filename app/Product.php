<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name', 'description', 'price', 'quantity', 'product_sub_category_id', 'product_category_id', 'barcode'
    ];
    
    public function product_sub_categories()
    {
        return $this->hasMany(ProductSubCategory::class);
    }

    public function product_categories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function addons()
    {
        return $this->hasMany(AddOn::class);
    }
}
