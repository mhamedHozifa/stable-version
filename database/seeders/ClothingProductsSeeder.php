<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClothingProductsSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete all existing clothing products.
        Product::query()->delete();

        $categories = [
            [
                'name' => "Men's Clothing",
                'slug' => 'mens-clothing',
                'description' => 'Classic and modern apparel for men, from shirts to outerwear.',
            ],
            [
                'name' => "Women's Clothing",
                'slug' => 'womens-clothing',
                'description' => 'Stylish women’s fashion, including dresses, tops, and knitwear.',
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Everyday fashion accessories to complete your look.',
            ],
            [
                'name' => 'Shoes',
                'slug' => 'shoes',
                'description' => 'Comfortable and fashionable footwear for all occasions.',
            ],
            [
                'name' => 'Sportswear',
                'slug' => 'sportswear',
                'description' => 'Performance-ready activewear for training and leisure.',
            ],
            [
                'name' => "Kids' Clothing",
                'slug' => 'kids-clothing',
                'description' => 'Durable and fun clothing for children and toddlers.',
            ],
        ];

        $categoryMap = [];
        foreach ($categories as $categoryData) {
            $category = Category::firstOrCreate(
                [
                    'name' => $categoryData['name'],
                    'site_type' => 'clothing',
                ],
                [
                    'slug' => $categoryData['slug'],
                    'description' => $categoryData['description'],
                ]
            );

            $categoryMap[$categoryData['name']] = $category->id;
        }

        $sizeOptions = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $shoeSizes = ['40', '41', '42', '43', '44', '45', '46'];
        $colorOptions = ['Black', 'White', 'Navy', 'Gray', 'Red', 'Olive', 'Beige', 'Burgundy'];

        $products = [
            [
                'name' => 'Classic Fit Cotton T-Shirt',
                'description' => 'Soft cotton tee with a comfortable classic fit for everyday wear.',
                'price' => 24.99,
                'stock' => 58,
                'category' => "Men's Clothing",
            ],
            [
                'name' => 'Slim Fit Chinos',
                'description' => 'Lightweight chino pants with a tailored slim silhouette.',
                'price' => 49.99,
                'stock' => 42,
                'category' => "Men's Clothing",
            ],
            [
                'name' => 'Oversized Denim Jacket',
                'description' => 'A versatile denim jacket with a relaxed oversized shape.',
                'price' => 79.99,
                'stock' => 31,
                'category' => "Men's Clothing",
            ],
            [
                'name' => 'Ribbed V-Neck Sweater',
                'description' => 'Soft knit sweater with a flattering ribbed texture.',
                'price' => 39.99,
                'stock' => 22,
                'category' => "Women's Clothing",
            ],
            [
                'name' => 'Floral Midi Dress',
                'description' => 'Feminine midi dress with a floral print and flowing skirt.',
                'price' => 59.99,
                'stock' => 28,
                'category' => "Women's Clothing",
            ],
            [
                'name' => 'High-Waist Stretch Jeans',
                'description' => 'Comfortable stretch denim with a flattering high waist.',
                'price' => 69.99,
                'stock' => 34,
                'category' => "Women's Clothing",
            ],
            [
                'name' => 'Everyday Leather Belt',
                'description' => 'Classic leather belt with a polished metal buckle.',
                'price' => 29.99,
                'stock' => 67,
                'category' => 'Accessories',
            ],
            [
                'name' => 'Knitted Beanie Hat',
                'description' => 'Cozy knit beanie designed for chilly weather and casual style.',
                'price' => 14.99,
                'stock' => 85,
                'category' => 'Accessories',
            ],
            [
                'name' => 'Leather Tote Bag',
                'description' => 'Spacious tote bag with clean lines and a durable leather finish.',
                'price' => 89.99,
                'stock' => 19,
                'category' => 'Accessories',
            ],
            [
                'name' => 'Running Sneakers',
                'description' => 'Lightweight running shoes with cushioning for daily workouts.',
                'price' => 99.99,
                'stock' => 46,
                'category' => 'Shoes',
            ],
            [
                'name' => 'Classic White Sneakers',
                'description' => 'Minimalist white sneakers built for comfort and street style.',
                'price' => 79.99,
                'stock' => 53,
                'category' => 'Shoes',
            ],
            [
                'name' => 'Chelsea Ankle Boots',
                'description' => 'Polished ankle boots with elastic side panels for easy wear.',
                'price' => 119.99,
                'stock' => 17,
                'category' => 'Shoes',
            ],
            [
                'name' => 'Performance Leggings',
                'description' => 'High-stretch leggings with moisture-wicking fabric for training.',
                'price' => 34.99,
                'stock' => 40,
                'category' => 'Sportswear',
            ],
            [
                'name' => 'Mesh Training Shorts',
                'description' => 'Breathable shorts designed for gym sessions and warm-weather workouts.',
                'price' => 27.99,
                'stock' => 50,
                'category' => 'Sportswear',
            ],
            [
                'name' => 'Quarter-Zip Sweatshirt',
                'description' => 'Soft sweatshirt with a quarter-zip neckline for layering comfort.',
                'price' => 44.99,
                'stock' => 36,
                'category' => 'Sportswear',
            ],
            [
                'name' => 'Graphic Tee for Kids',
                'description' => 'Playful cotton tee with a fun graphic for everyday wear.',
                'price' => 19.99,
                'stock' => 58,
                'category' => "Kids' Clothing",
            ],
            [
                'name' => 'Kids’ Stretch Joggers',
                'description' => 'Soft joggers with an elastic waist for comfort and movement.',
                'price' => 24.99,
                'stock' => 45,
                'category' => "Kids' Clothing",
            ],
            [
                'name' => 'Toddler Fleece Hoodie',
                'description' => 'Cozy fleece hoodie with a warm interior for cooler days.',
                'price' => 29.99,
                'stock' => 33,
                'category' => "Kids' Clothing",
            ],
            [
                'name' => 'Crossbody Phone Pouch',
                'description' => 'Compact crossbody pouch designed to keep essentials close at hand.',
                'price' => 22.99,
                'stock' => 60,
                'category' => 'Accessories',
            ],
        ];

        foreach ($products as $productData) {
            $isShoe = $productData['category'] === 'Shoes';

            Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'stock' => $productData['stock'],
                'category_id' => $categoryMap[$productData['category']],
                'image' => 'products/clothing_placeholder.jpg',
                'is_featured' => (bool) rand(0, 1),
                'attributes' => [
                    'size' => $isShoe
                        ? $shoeSizes[array_rand($shoeSizes)]
                        : $sizeOptions[array_rand($sizeOptions)],
                    'color' => $colorOptions[array_rand($colorOptions)],
                ],
            ]);
        }
    }
}
