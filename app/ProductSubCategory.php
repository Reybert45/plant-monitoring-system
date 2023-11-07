<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    protected $table = 'product_sub_categories';

    protected $fillable = ['name', 'description'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
