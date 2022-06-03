<?php

namespace Modules\Item\Tests\Unit;

use Tests\TestCase;
class DeleteItemTest extends TestCase
{
    protected $model = \Modules\Item\Entities\Item\Item::class;

    /**
     * @test *
     * When user submits put request to update an item completion endpoint
     *
     * @return void
     */
    public function users_can_update_item()
    {
        $item = $this->model::factory()->create();
        $response = $this->json('delete', '/api/items/'.$item->id);
        $response->assertStatus(200);
        //We considered '200' for the success operation
        $sucessCode = $response->decodeResponseJson()['code'];
        $this->assertEquals(200, $sucessCode);
    }
}
