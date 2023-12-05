<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'purchase_price',
        'quantity_changes',
    ];

    protected $appends = [
        'purchase_price_formatted',
        'current_quantity'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $product = Product::find($model->product_id);
            $model->quantity_changes = $product->quantity + $model->quantity;
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function items()
    {
        return $this->hasMany(InventoryItem::class);
    }

    public function getPurchasePriceFormattedAttribute()
    {
        return number_format($this->purchase_price, 0, ',', '.');
    }

    public function getCurrentQuantityAttribute()
    {
        return $this->hasMany(InventoryItem::class)->where('sold', false)->count();
    }
}
