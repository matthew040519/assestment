<?php

namespace Tests\Unit;

use App\Models\products;
use PHPUnit\Framework\TestCase;


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
}
