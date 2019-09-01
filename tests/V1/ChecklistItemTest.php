<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ChecklistItemTest extends TestCase
{
    use DatabaseMigrations;

    private $key;
    private $checklist;
    private $checklistItems;

    private $serverParams;

    public function setUp() : void
    {
        parent::setUp();
        $this->key = 'key:'.env('APP_KEY');
        $this->serverParams = [
            'HTTP_AUTHORIZATION' => $this->key,
        ];
        $this->checklist = factory(\App\Checklist::class)->create();
        $this->checklistItems = factory(\App\Item::class,5)->create(['checklist_id' => $this->checklist->id]);
    }

    public function tearDown() : void
    {
        parent::tearDown();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetListItemsInsideChecklist()
    {
        $this->call('GET', '/api/v1/checklists/'.$this->checklist->id.'/items', [], [], [], $this->serverParams);

        $this->assertResponseStatus(200);
    }
}
