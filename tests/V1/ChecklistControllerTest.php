<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ChecklistControllerTest extends TestCase
{
    use DatabaseMigrations;

    private $key;
    private $checklist;

    private $serverParams;

    public function setUp() : void
    {
        parent::setUp();
        $this->key = 'key:'.env('APP_KEY');
        $this->serverParams = [
            'HTTP_AUTHORIZATION' => $this->key,
        ];
        $this->checklist = factory(\App\Checklist::class)->create();
    }

    public function tearDown() : void
    {
        parent::tearDown();
    }

    public function testApiWithoutCredentials()
    {
        $this->call('GET', '/api/v1/checklists/1');
        $this->assertResponseStatus(401);
    }

    public function testGetChecklistNotFound()
    {
        $this->call('GET', "/api/v1/checklists/999Test", [], [], [], $this->serverParams);
        $this->assertResponseStatus(404);
    }

    public function testGetChecklist()
    {
        $this->call('GET', '/api/v1/checklists/'.$this->checklist->id, [], [], [], $this->serverParams);

        $this->assertResponseStatus(200);
        $this->seeJsonStructure([
            'data' => [
                'attributes' => [],
                'links' => []
            ]
        ]);
    }

}
