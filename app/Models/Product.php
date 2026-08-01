<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use App\Models\InventoryChange;

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

    public function inventoryChanges()
    {
        return $this->hasMany(InventoryChange::class);
    }

    protected static function booted()
    {
        static::updating(function ($product) {
            if ($product->isDirty('quantity')) {
                $original = $product->getOriginal('quantity');
                $new = $product->quantity;
                $change = $new - $original;
                $type = $change > 0 ? 'increase' : ($change < 0 ? 'sold' : 'none');

                // only record real changes
                if ($type !== 'none' && $change !== 0) {
                    InventoryChange::create([
                        'product_id' => $product->id,
                        'user_id' => Auth::id(),
                        'old_quantity' => $original,
                        'new_quantity' => $new,
                        // store absolute quantity moved for reporting clarity
                        'change' => abs($change),
                        'type' => $type,
                        'note' => $type === 'increase' ? 'Stock in' : 'Stock out',
                    ]);
                }
            }
        });
    }

}
