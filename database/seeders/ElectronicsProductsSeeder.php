<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ElectronicsProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Laptops',
                'slug' => 'laptops',
                'description' => 'Portable computers for work and gaming',
            ],
            [
                'name' => 'Desktops',
                'slug' => 'desktops',
                'description' => 'Powerful desktop computers and workstations',
            ],
            [
                'name' => 'Computer Accessories',
                'slug' => 'computer-accessories',
                'description' => 'Keyboards, mice, monitors and more',
            ],
            [
                'name' => 'Networking',
                'slug' => 'networking',
                'description' => 'Routers, switches, and network devices',
            ],
        ];

        $categoryMap = [];
        foreach ($categories as $categoryData) {
            $category = Category::firstOrCreate(
                [
                    'name' => $categoryData['name'],
                    'site_type' => 'electronics',
                ],
                [
                    'slug' => $categoryData['slug'],
                    'description' => $categoryData['description'],
                ]
            );

            $categoryMap[$categoryData['name']] = $category->id;
        }

        $products = [
            [
                'name' => 'MacBook Air M2',
                'description' => 'Ultra-light laptop with Apple M2 chip and all-day battery life.',
                'price' => 1199.99,
                'stock' => 24,
                'category' => 'Laptops',
                'attributes' => ['processor' => 'M2', 'ram' => '8GB', 'storage' => '256GB SSD', 'screen' => '13.6-inch'],
            ],
            [
                'name' => 'Dell XPS 15',
                'description' => 'Premium 15-inch laptop with vivid display and strong productivity performance.',
                'price' => 1599.99,
                'stock' => 18,
                'category' => 'Laptops',
                'attributes' => ['processor' => 'Intel Core i7', 'ram' => '16GB', 'storage' => '512GB SSD', 'screen' => '15.6-inch'],
            ],
            [
                'name' => 'HP Spectre x360',
                'description' => 'Convertible laptop with touchscreen and elegant aluminum design.',
                'price' => 1399.99,
                'stock' => 15,
                'category' => 'Laptops',
                'attributes' => ['processor' => 'Intel Core i5', 'ram' => '16GB', 'storage' => '512GB SSD', 'screen' => '14-inch'],
            ],
            [
                'name' => 'Lenovo ThinkPad X1',
                'description' => 'Business-class laptop made for reliability, portability, and security.',
                'price' => 1499.99,
                'stock' => 12,
                'category' => 'Laptops',
                'attributes' => ['processor' => 'Intel Core i7', 'ram' => '16GB', 'storage' => '1TB SSD', 'screen' => '14-inch'],
            ],
            [
                'name' => 'ASUS ROG Zephyrus G14',
                'description' => 'Compact gaming laptop with high refresh rate display and Ryzen power.',
                'price' => 1899.99,
                'stock' => 10,
                'category' => 'Laptops',
                'attributes' => ['processor' => 'AMD Ryzen 9', 'ram' => '32GB', 'storage' => '1TB SSD', 'screen' => '14-inch'],
            ],
            [
                'name' => 'Apple iMac 24-inch',
                'description' => 'All-in-one desktop with vivid Retina display and sleek modern design.',
                'price' => 1799.99,
                'stock' => 9,
                'category' => 'Desktops',
                'attributes' => ['processor' => 'Apple M1', 'ram' => '16GB', 'storage' => '512GB SSD', 'form_factor' => 'AIO'],
            ],
            [
                'name' => 'HP Pavilion Desktop',
                'description' => 'Balanced desktop computer ideal for home office and everyday tasks.',
                'price' => 799.99,
                'stock' => 20,
                'category' => 'Desktops',
                'attributes' => ['processor' => 'Intel i5', 'ram' => '16GB', 'storage' => '512GB SSD + 1TB HDD', 'form_factor' => 'Tower'],
            ],
            [
                'name' => 'Dell Inspiron Desktop',
                'description' => 'Reliable tower desktop suited for multimedia, study, and work.',
                'price' => 699.99,
                'stock' => 16,
                'category' => 'Desktops',
                'attributes' => ['processor' => 'Intel i5', 'ram' => '8GB', 'storage' => '512GB SSD', 'form_factor' => 'Tower'],
            ],
            [
                'name' => 'Custom Gaming PC RTX 4060',
                'description' => 'High-performance gaming desktop with dedicated RTX 4060 graphics.',
                'price' => 1499.99,
                'stock' => 8,
                'category' => 'Desktops',
                'attributes' => ['processor' => 'Intel i7', 'ram' => '32GB', 'storage' => '1TB SSD', 'graphics' => 'RTX 4060'],
            ],
            [
                'name' => 'Lenovo IdeaCentre AIO',
                'description' => 'Space-saving all-in-one desktop with a clean, modern footprint.',
                'price' => 899.99,
                'stock' => 11,
                'category' => 'Desktops',
                'attributes' => ['processor' => 'Intel i3', 'ram' => '8GB', 'storage' => '256GB SSD', 'form_factor' => 'AIO'],
            ],
            [
                'name' => 'Logitech MX Master 3S Mouse',
                'description' => 'Precision wireless mouse designed for productivity and comfort.',
                'price' => 99.99,
                'stock' => 35,
                'category' => 'Computer Accessories',
                'attributes' => ['type' => 'Wireless', 'connectivity' => 'Bluetooth', 'color' => 'Graphite'],
            ],
            [
                'name' => 'Samsung 27-inch 4K Monitor',
                'description' => 'Sharp 4K display with vibrant colors and slim bezels.',
                'price' => 349.99,
                'stock' => 22,
                'category' => 'Computer Accessories',
                'attributes' => ['type' => 'Monitor', 'resolution' => '4K UHD', 'panel' => 'IPS', 'size' => '27-inch'],
            ],
            [
                'name' => 'Mechanical Keyboard RGB',
                'description' => 'Tactile mechanical keyboard with customizable RGB lighting.',
                'price' => 89.99,
                'stock' => 30,
                'category' => 'Computer Accessories',
                'attributes' => ['type' => 'Keyboard', 'switches' => 'Brown', 'connectivity' => 'USB', 'color' => 'Black'],
            ],
            [
                'name' => 'USB-C Hub 7-in-1',
                'description' => 'Compact hub for expanding USB-C ports and connectivity options.',
                'price' => 49.99,
                'stock' => 40,
                'category' => 'Computer Accessories',
                'attributes' => ['type' => 'Hub', 'connectivity' => 'USB-C', 'ports' => 'HDMI, USB-A, SD'],
            ],
            [
                'name' => 'Wireless Ergonomic Keyboard',
                'description' => 'Comfort-focused keyboard with a split layout and low-profile keys.',
                'price' => 79.99,
                'stock' => 27,
                'category' => 'Computer Accessories',
                'attributes' => ['type' => 'Keyboard', 'connectivity' => 'Bluetooth', 'color' => 'White'],
            ],
            [
                'name' => 'TP-Link Archer AX73 Router',
                'description' => 'Wi-Fi 6 router with strong performance for gaming and streaming.',
                'price' => 179.99,
                'stock' => 19,
                'category' => 'Networking',
                'attributes' => ['speed' => 'AX5400', 'ports' => '4x LAN', 'features' => 'MU-MIMO, OFDMA'],
            ],
            [
                'name' => 'Netgear 8-Port Gigabit Switch',
                'description' => 'Reliable switch for expanding wired network connections in the home or office.',
                'price' => 59.99,
                'stock' => 26,
                'category' => 'Networking',
                'attributes' => ['speed' => '1Gbps', 'ports' => '8x LAN', 'features' => 'Plug and play'],
            ],
            [
                'name' => 'Mesh WiFi System (3-pack)',
                'description' => 'Whole-home mesh system that eliminates dead zones and improves coverage.',
                'price' => 249.99,
                'stock' => 14,
                'category' => 'Networking',
                'attributes' => ['speed' => 'AX3000', 'coverage' => 'Up to 5,500 sq ft', 'features' => 'Parental controls'],
            ],
            [
                'name' => 'Ethernet Cable Cat7 10ft',
                'description' => 'Shielded Cat7 cable built for fast and stable wired connections.',
                'price' => 14.99,
                'stock' => 45,
                'category' => 'Networking',
                'attributes' => ['speed' => '10Gbps', 'length' => '10ft', 'shielding' => 'STP'],
            ],
            [
                'name' => 'USB WiFi Adapter AC1300',
                'description' => 'Compact adapter for upgrading older devices to modern wireless networks.',
                'price' => 29.99,
                'stock' => 33,
                'category' => 'Networking',
                'attributes' => ['speed' => 'AC1300', 'connectivity' => 'USB 2.0', 'frequency' => '2.4/5 GHz'],
            ],
        ];

        $featuredIndices = array_rand(array_map(fn ($index) => $index, range(0, count($products) - 1)), 5);
        if (!is_array($featuredIndices)) {
            $featuredIndices = [$featuredIndices];
        }

        foreach ($products as $index => $productData) {
            Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'stock' => $productData['stock'],
                'category_id' => $categoryMap[$productData['category']],
                'image' => 'products/electronics_placeholder.jpg',
                'is_featured' => in_array($index, $featuredIndices, true),
                'attributes' => $productData['attributes'],
            ]);
        }
    }
}
