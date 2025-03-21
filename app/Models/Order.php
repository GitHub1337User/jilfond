<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    use AsSource;

    protected $fillable = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')
                    ->withPivot('quantity');
    }

    public function getProductNames()
    {
        return $this->products->map(function ($product) {
            return $product->name . ' (' . $product->pivot->quantity . 'шт.)';
        })->implode(', ');
    }

    public function getTotalPrice()
    {
        $products = $this->products;


        $totalPrice = $products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        return $totalPrice;
    }

    public static function getTotalPriceOfAllOrders()
    {
        // Cache::forget('total_price_of_all_orders');
        // Здесь можно использовать сырой запрос к бд, так по логике будет более оптимально по ресурсам и скорости выполнения
        return Cache::remember('total_price_of_all_orders', 3600, function () {
            return DB::table('order_products')
                ->join('products', 'order_products.product_id', '=', 'products.id')
                ->selectRaw('SUM(products.price * order_products.quantity) as total_price')
                ->value('total_price') ?? 0;
        });
    }
}
