<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\File;

class FileApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_file()
    {
        $file = factory(File::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/files', $file
        );

        $this->assertApiResponse($file);
    }

    /**
     * @test
     */
    public function test_read_file()
    {
        $file = factory(File::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/files/'.$file->id
        );

        $this->assertApiResponse($file->toArray());
    }

    /**
     * @test
     */
    public function test_update_file()
    {
        $file = factory(File::class)->create();
        $editedFile = factory(File::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/files/'.$file->id,
            $editedFile
        );

        $this->assertApiResponse($editedFile);
    }

    /**
     * @test
     */
    public function test_delete_file()
    {
        $file = factory(File::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/files/'.$file->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/files/'.$file->id
        );

        $this->response->assertStatus(404);
    }
}
