<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','title','stock','alert_ceil','image','purchase_price','selling_price','active'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getRouteKeyName(): string
    {
        return 'reference';
    }

    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            $product->reference = 'PRD-' . now()->format('ymd') . '-' . strtoupper( Str::random(2) ) . random_int(10,99);
        });
    }
}
