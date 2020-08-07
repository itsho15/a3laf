<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Complaint;

class ComplaintApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_complaint()
    {
        $complaint = factory(Complaint::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/admin/complaints', $complaint
        );

        $this->assertApiResponse($complaint);
    }

    /**
     * @test
     */
    public function test_read_complaint()
    {
        $complaint = factory(Complaint::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/admin/complaints/'.$complaint->id
        );

        $this->assertApiResponse($complaint->toArray());
    }

    /**
     * @test
     */
    public function test_update_complaint()
    {
        $complaint = factory(Complaint::class)->create();
        $editedComplaint = factory(Complaint::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/admin/complaints/'.$complaint->id,
            $editedComplaint
        );

        $this->assertApiResponse($editedComplaint);
    }

    /**
     * @test
     */
    public function test_delete_complaint()
    {
        $complaint = factory(Complaint::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/admin/complaints/'.$complaint->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/admin/complaints/'.$complaint->id
        );

        $this->response->assertStatus(404);
    }
}
