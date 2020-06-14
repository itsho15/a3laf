<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Category;

class CategoryApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_category()
    {
        $category = factory(Category::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/categories', $category
        );

        $this->assertApiResponse($category);
    }

    /**
     * @test
     */
    public function test_read_category()
    {
        $category = factory(Category::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/categories/'.$category->id
        );

        $this->assertApiResponse($category->toArray());
    }

    /**
     * @test
     */
    public function test_update_category()
    {
        $category = factory(Category::class)->create();
        $editedCategory = factory(Category::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/categories/'.$category->id,
            $editedCategory
        );

        $this->assertApiResponse($editedCategory);
    }

    /**
     * @test
     */
    public function test_delete_category()
    {
        $category = factory(Category::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/categories/'.$category->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/categories/'.$category->id
        );

        $this->response->assertStatus(404);
    }
}
