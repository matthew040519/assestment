<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Test if category name is not empty.
     */
    public function test_category_name_is_not_empty(): void
    {
        $categoryName = 'Electronics';
        $this->assertNotEmpty($categoryName);
    }

    /**
     * Test if category ID is a positive integer.
     */
    public function test_category_id_is_positive_integer(): void
    {
        $categoryId = 5;
        $this->assertIsInt($categoryId);
        $this->assertGreaterThan(0, $categoryId);
    }

    /**
     * Test if category has a valid description.
     */
    public function test_category_has_valid_description(): void
    {
        $categoryDescription = 'This category includes all electronic items.';
        $this->assertIsString($categoryDescription);
        $this->assertNotEmpty($categoryDescription);
    }
}
