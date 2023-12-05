<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'inventory_id',
        'purchase_price',
        'sold',
    ];

    protected $casts = [
        'sold' => 'boolean'
    ];

    protected static function booted()
    {
        //
    }
}
