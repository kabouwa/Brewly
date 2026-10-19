<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title','active'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }


    protected static function booted(): void
    {
        static::saving(function (Category $category) {
            if ($category->isDirty('title')) {
                $category->slug = Str::slug($category->title);
            }
        });

        // For soft delete
        // static::deleting(function (Category $category) {
        //     $category->products()->delete();
        // });
    }
}
