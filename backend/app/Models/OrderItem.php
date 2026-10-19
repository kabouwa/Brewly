<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','order_id','selling_price','purchase_price','quantity'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function booted(): void
    {
        static::deleting(function (OrderItem $orderItem) {
            if ($orderItem->product) {
                $orderItem->product()->update([
                    'stock' => $orderItem->product->stock + $orderItem->quantity,
                ]);
            }
        });
    }
}
