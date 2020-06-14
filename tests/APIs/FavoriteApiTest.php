<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Favorite;

class FavoriteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_favorite()
    {
        $favorite = factory(Favorite::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/favorites', $favorite
        );

        $this->assertApiResponse($favorite);
    }

    /**
     * @test
     */
    public function test_read_favorite()
    {
        $favorite = factory(Favorite::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/favorites/'.$favorite->id
        );

        $this->assertApiResponse($favorite->toArray());
    }

    /**
     * @test
     */
    public function test_update_favorite()
    {
        $favorite = factory(Favorite::class)->create();
        $editedFavorite = factory(Favorite::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/favorites/'.$favorite->id,
            $editedFavorite
        );

        $this->assertApiResponse($editedFavorite);
    }

    /**
     * @test
     */
    public function test_delete_favorite()
    {
        $favorite = factory(Favorite::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/favorites/'.$favorite->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/favorites/'.$favorite->id
        );

        $this->response->assertStatus(404);
    }
}
