<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'cart_total',
        'role_name'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function getCartTotalAttribute()
    {
        $total = 0;

        if (!isset(auth()->user()->carts)) {
          return ['formatted' => 0, 'raw' => 0];
        }

        $carts = auth()->user()->carts;
        foreach ($carts as $cart) {
            $total += $cart->product->price * $cart->qty;
        }

        return ['formatted' => number_format($total, 0, ',', '.'), 'raw' => $total];
    }

    public function getRoleNameAttribute()
    {
        switch ($this->role) {
            case 0:
                return 'Admin';
            break;
            case 1:
                return 'Kepala Depo';
            break;
            default:
                return 'User';
            break;
        }
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
