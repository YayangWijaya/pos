<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'unit'
    ];

    protected $appends = [
        'price_formatted',
        'image_link',
        'quantity',
        'sold',
        'cart'
    ];

    protected static function booted()
    {
        //
    }

    public function inventory()
    {
        return $this->hasMany(InventoryItem::class)->where('sold', false);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getPriceFormattedAttribute()
    {
        return number_format($this->price, 0, ',',' .');
    }

    public function getImageLinkAttribute()
    {
        return Storage::url($this->image->path);
    }

    public function getQuantityAttribute()
    {
        return $this->hasMany(InventoryItem::class)->where('sold', false)->count();
    }

    public function getSoldAttribute()
    {
        return $this->hasMany(InventoryItem::class)->where('sold', true)->count();
    }

    public function getCartAttribute()
    {
        $user = User::find(auth()->id());
        $qty = $user->carts()->where('product_id', $this->id)->value('qty');

        if ($qty) {
            return $qty;
        }

        return 0;
    }
}
