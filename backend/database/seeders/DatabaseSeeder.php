<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    private function users(int $count = 10): void
    {
        User::factory($count)->create();
        User::create([
            'name' => 'Mohammed',
            'email' => 'mohammed@mail.com',
            'phone' => '0666666666',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
    }
    private function categories(int $count = 10): void
    {
        Category::factory($count)->create();
    }
    private function products(int $count = 10): void
    {
        Product::factory($count)->create();
    }
    private function orders(int $count = 10): void
    {
        Order::factory($count)->create();
    }
    private function orderItems(int $count = 10): void
    {
        OrderItem::factory($count)->create();
    }

    public function run(): void
    {
        $this->users(2);
        $this->categories(10);
        $this->products(50);
        $this->orders(40);
        $this->orderItems(100);
    }
}
