<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'imageable_type',
        'imageable_id',
        'name',
        'path',
        'mime',
        'size'
    ];

    protected static function booted()
    {
        //
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
