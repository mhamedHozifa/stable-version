<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_access_products_index_page(): void
    {
        $response = $this->get('/products');

        $response->assertOk();
        $response->assertSee('Our Products');
    }

    public function test_products_index_shows_name_price_and_image(): void
    {
        $product = Product::create([
            'name' => 'Catalog Product',
            'description' => 'Catalog Description',
            'price' => 149.99,
            'stock' => 10,
            'image' => 'products/catalog-image.jpg',
        ]);

        $response = $this->get('/products');

        $response->assertOk();
        $response->assertSee($product->name);
        $response->assertSee('$149.99');
        $response->assertSee('storage/products/catalog-image.jpg');
    }

    public function test_products_index_is_paginated(): void
    {
        for ($i = 1; $i <= 13; $i++) {
            Product::create([
                'name' => 'Product ' . $i,
                'description' => 'Description ' . $i,
                'price' => 10 + $i,
                'stock' => 5,
            ]);
        }

        $response = $this->get('/products');

        $response->assertOk();
        $response->assertSee('?page=2');
    }

    public function test_guest_can_access_single_product_page(): void
    {
        $product = Product::create([
            'name' => 'Show Product',
            'description' => 'Details',
            'price' => 59.50,
            'stock' => 8,
        ]);

        $response = $this->get('/products/' . $product->id);

        $response->assertOk();
        $response->assertSee($product->name);
        $response->assertSee('$59.50');
    }

    public function test_non_existent_product_returns_404(): void
    {
        $response = $this->get('/products/999999');

        $response->assertNotFound();
    }

    public function test_product_with_no_image_shows_placeholder(): void
    {
        $product = Product::create([
            'name' => 'No Image Product',
            'description' => 'No image provided',
            'price' => 20.00,
            'stock' => 3,
            'image' => null,
        ]);

        $response = $this->get('/products');

        $response->assertOk();
        $response->assertSee($product->name);
        $response->assertSee('images/no-image.svg');
    }
}
