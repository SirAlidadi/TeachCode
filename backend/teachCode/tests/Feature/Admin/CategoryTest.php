<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected $data = [
        'name' => 'name form test',
        'slug' => 'name-from-test'
    ];

    public function testIndexCategory()
    {
        Category::factory()->create();

        $response = $this->getJson(route('admin.categories.index'))->assertOk()->json();

        $this->assertEquals(1, count($response));
    }

    public function testShowCategory()
    {
        $category = Category::factory()->create();

        $response = $this->getJson(route('admin.categories.show', $category->slug))->json();

        $this->assertEquals($category->name, $response['data']['name']);
    }

    public function testStoreCategory()
    {
        $response = $this->postJson(route('admin.categories.store'), $this->data)->assertCreated()
            ->json();

        $this->assertEquals('created', $response['message']);
    }

    public function testUpdateCategory()
    {
        $category = Category::factory()->create();

        $this->putJson(route('admin.categories.update', $category->slug), $this->data)->assertOk();
    }

    public function testDestroyCategory()
    {
        $category = Category::factory()->create();

        $this->deleteJson(route('admin.categories.destroy',  $category->id))->assertOk();
    }
}
