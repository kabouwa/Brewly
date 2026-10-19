<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['note','total_price','status'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getRouteKeyName(): string
    {
        return 'reference';
    }

    protected static function booted(): void
    {
        static::creating(function (Order $order) {
            $order->reference = 'ORD-' . now()->format('ymd') . '-' . strtoupper( Str::random(2) ) . random_int(10,99);
        });

        // For soft delete
        // static::deleting(function (Order $order) {
        //     $order->items()->delete();
        // });
    }
}
