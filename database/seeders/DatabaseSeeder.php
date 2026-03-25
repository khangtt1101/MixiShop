<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Men', 'slug' => 'men'],
            ['name' => 'Women', 'slug' => 'women'],
            ['name' => 'Accessories', 'slug' => 'accessories'],
            ['name' => 'Shoes', 'slug' => 'shoes'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $products = [
            ['category_id' => 1, 'name' => 'Classic White Tee', 'slug' => 'classic-white-tee', 'price' => 29.99, 'description' => 'A premium cotton classic white tee.'],
            ['category_id' => 1, 'name' => 'Denim Jacket', 'slug' => 'denim-jacket', 'price' => 89.99, 'description' => 'Vintage wash denim jacket.'],
            ['category_id' => 2, 'name' => 'Floral Summer Dress', 'slug' => 'floral-summer-dress', 'price' => 59.99, 'description' => 'Light and breezy floral dress.'],
            ['category_id' => 3, 'name' => 'Leather Wallet', 'slug' => 'leather-wallet', 'price' => 49.99, 'description' => 'Genuine leather minimalist wallet.'],
            ['category_id' => 4, 'name' => 'Running Sneakers', 'slug' => 'running-sneakers', 'price' => 120.00, 'description' => 'Comfortable high-performance sneakers.'],
        ];

        foreach ($products as $prod) {
            $p = Product::create($prod);
            
            ProductVariant::create(['product_id' => $p->id, 'size' => 'M', 'color' => '#ffffff', 'stock_quantity' => 10]);
            ProductVariant::create(['product_id' => $p->id, 'size' => 'L', 'color' => '#000000', 'stock_quantity' => 5]);
            
            ProductImage::create([
                'product_id' => $p->id, 
                'image_path' => 'https://via.placeholder.com/600x800.png?text=' . urlencode($p->name), 
                'is_primary' => true
            ]);
        }
    }
}
