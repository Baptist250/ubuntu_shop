<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'old_quantity',
        'new_quantity',
        'change',
        'type',
        'note',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTypeLabelAttribute()
    {
        return match ($this->type) {
            'sold' => 'Sold',
            'sale' => 'Sale',
            'increase' => 'Increase',
            'stock_in' => 'Stock In',
            'stock_out' => 'Stock Out',
            default => ucfirst($this->type),
        };
    }
}
