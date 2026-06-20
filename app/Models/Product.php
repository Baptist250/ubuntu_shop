<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'name',
    'brand',
    'description',
    'buying_price',
    'selling_price',
    'quantity',
    'image',
];
public function items()
{
    return $this->hasMany(SaleItem::class);
}
public function product()
{
    return $this->belongsTo(Product::class);
}
public function saleItems()
{
    return $this->hasMany(SaleItem::class);
}

}
