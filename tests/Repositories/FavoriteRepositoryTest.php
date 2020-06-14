<?php namespace Tests\Repositories;

use App\Models\Favorite;
use App\Repositories\FavoriteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class FavoriteRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var FavoriteRepository
     */
    protected $favoriteRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->favoriteRepo = \App::make(FavoriteRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_favorite()
    {
        $favorite = factory(Favorite::class)->make()->toArray();

        $createdFavorite = $this->favoriteRepo->create($favorite);

        $createdFavorite = $createdFavorite->toArray();
        $this->assertArrayHasKey('id', $createdFavorite);
        $this->assertNotNull($createdFavorite['id'], 'Created Favorite must have id specified');
        $this->assertNotNull(Favorite::find($createdFavorite['id']), 'Favorite with given id must be in DB');
        $this->assertModelData($favorite, $createdFavorite);
    }

    /**
     * @test read
     */
    public function test_read_favorite()
    {
        $favorite = factory(Favorite::class)->create();

        $dbFavorite = $this->favoriteRepo->find($favorite->id);

        $dbFavorite = $dbFavorite->toArray();
        $this->assertModelData($favorite->toArray(), $dbFavorite);
    }

    /**
     * @test update
     */
    public function test_update_favorite()
    {
        $favorite = factory(Favorite::class)->create();
        $fakeFavorite = factory(Favorite::class)->make()->toArray();

        $updatedFavorite = $this->favoriteRepo->update($fakeFavorite, $favorite->id);

        $this->assertModelData($fakeFavorite, $updatedFavorite->toArray());
        $dbFavorite = $this->favoriteRepo->find($favorite->id);
        $this->assertModelData($fakeFavorite, $dbFavorite->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_favorite()
    {
        $favorite = factory(Favorite::class)->create();

        $resp = $this->favoriteRepo->delete($favorite->id);

        $this->assertTrue($resp);
        $this->assertNull(Favorite::find($favorite->id), 'Favorite should not exist in DB');
    }
}
