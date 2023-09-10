<?php

namespace Tests\Unit\Domain\Entity;

use Core\Domain\Entity\Category;
use Core\Domain\Exception\EntityValidationException;
use PHPUnit\Framework\TestCase;

class CategoryUnitTest extends TestCase
{
    public function testAttributes()
    {
        $category = new Category(
            name: "New Category",
            description: "New Description",
            isActive: true
        );

        $this->assertEquals('New Category', $category->name);
        $this->assertEquals('New Description', $category->description);
        $this->assertTrue($category->isActive);
    }

    public function testActivated()
    {
        $category = new Category(
            name: 'New Category',
            isActive: false,
        );
        $this->assertFalse($category->isActive);
        $category->activate();
        $this->assertTrue($category->isActive);
    }

    public function testDisabled()
    {
        $category = new Category(
            name: 'New Category',
            isActive: true,
        );
        $this->assertTrue($category->isActive);
        $category->disable();
        $this->assertFalse($category->isActive);
    }

    public function testUpdate()
    {
        $uuid = 'uuid.value';

        $category = new Category(
            id: $uuid,
            name: "New Category",
            description: "New Description",
        );

        $category->update(
            name: "New Name",
            description: 'New Description'
        );

        $this->assertEquals('New Name', $category->name);
        $this->assertEquals('New Description', $category->description);
    }


    public function testException()
    {
        try {
            $category = new Category(
                name: 'Ne',
                description: 'New Desc'
            );
            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}
