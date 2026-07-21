<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'total_amount',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'cashier_id',
        'invoice_number',
    ];
    public function items()
{
    return $this->hasMany(\App\Models\SaleItem::class);
}
public function cashier()
{
    return $this->belongsTo(User::class, 'cashier_id');
}

}
