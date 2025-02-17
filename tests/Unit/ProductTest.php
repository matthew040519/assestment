<?php

namespace Tests\Unit;

use App\Models\products;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;


class ProductTest extends TestCase
{
    public function testProductName()
        {
            $product = new products();
            $product->name = 'Test Product';
            $this->assertEquals('Test Product', $product->name);
        }

        public function testProductPrice()
        {
            $product = new products();
            $product->price = 100;
            $this->assertEquals(100, $product->price);
        }

        public function testProductDescription()
        {
            $product = new products();
            $product->description = 'This is a test product';
            $this->assertEquals('This is a test product', $product->description);
        }
        public function testAllProductApi()
        {
            $response = $this->get('http://127.0.0.1:8000/api/getProducts');
            $response->assertJson([
            'id' => 1,
            'name' => 'Test Product',
            'price' => 100,
            'description' => 'This is a test product',
            ]);
        }
}
