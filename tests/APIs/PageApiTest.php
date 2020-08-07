<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Page;

class PageApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_page()
    {
        $page = factory(Page::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/pages', $page
        );

        $this->assertApiResponse($page);
    }

    /**
     * @test
     */
    public function test_read_page()
    {
        $page = factory(Page::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/pages/'.$page->id
        );

        $this->assertApiResponse($page->toArray());
    }

    /**
     * @test
     */
    public function test_update_page()
    {
        $page = factory(Page::class)->create();
        $editedPage = factory(Page::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/pages/'.$page->id,
            $editedPage
        );

        $this->assertApiResponse($editedPage);
    }

    /**
     * @test
     */
    public function test_delete_page()
    {
        $page = factory(Page::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/pages/'.$page->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/pages/'.$page->id
        );

        $this->response->assertStatus(404);
    }
}
