<?php namespace Tests\Repositories;

use App\Models\Complaint;
use App\Repositories\ComplaintRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ComplaintRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ComplaintRepository
     */
    protected $complaintRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->complaintRepo = \App::make(ComplaintRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_complaint()
    {
        $complaint = factory(Complaint::class)->make()->toArray();

        $createdComplaint = $this->complaintRepo->create($complaint);

        $createdComplaint = $createdComplaint->toArray();
        $this->assertArrayHasKey('id', $createdComplaint);
        $this->assertNotNull($createdComplaint['id'], 'Created Complaint must have id specified');
        $this->assertNotNull(Complaint::find($createdComplaint['id']), 'Complaint with given id must be in DB');
        $this->assertModelData($complaint, $createdComplaint);
    }

    /**
     * @test read
     */
    public function test_read_complaint()
    {
        $complaint = factory(Complaint::class)->create();

        $dbComplaint = $this->complaintRepo->find($complaint->id);

        $dbComplaint = $dbComplaint->toArray();
        $this->assertModelData($complaint->toArray(), $dbComplaint);
    }

    /**
     * @test update
     */
    public function test_update_complaint()
    {
        $complaint = factory(Complaint::class)->create();
        $fakeComplaint = factory(Complaint::class)->make()->toArray();

        $updatedComplaint = $this->complaintRepo->update($fakeComplaint, $complaint->id);

        $this->assertModelData($fakeComplaint, $updatedComplaint->toArray());
        $dbComplaint = $this->complaintRepo->find($complaint->id);
        $this->assertModelData($fakeComplaint, $dbComplaint->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_complaint()
    {
        $complaint = factory(Complaint::class)->create();

        $resp = $this->complaintRepo->delete($complaint->id);

        $this->assertTrue($resp);
        $this->assertNull(Complaint::find($complaint->id), 'Complaint should not exist in DB');
    }
}
