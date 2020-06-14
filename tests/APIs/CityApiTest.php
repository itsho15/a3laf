<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\City;

class CityApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_city()
    {
        $city = factory(City::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/cities', $city
        );

        $this->assertApiResponse($city);
    }

    /**
     * @test
     */
    public function test_read_city()
    {
        $city = factory(City::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/cities/'.$city->id
        );

        $this->assertApiResponse($city->toArray());
    }

    /**
     * @test
     */
    public function test_update_city()
    {
        $city = factory(City::class)->create();
        $editedCity = factory(City::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/cities/'.$city->id,
            $editedCity
        );

        $this->assertApiResponse($editedCity);
    }

    /**
     * @test
     */
    public function test_delete_city()
    {
        $city = factory(City::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/cities/'.$city->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/cities/'.$city->id
        );

        $this->response->assertStatus(404);
    }
}
