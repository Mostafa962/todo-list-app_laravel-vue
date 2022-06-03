<?php

namespace Modules\Item\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StoreItemTest extends TestCase
{
    // use DatabaseMigrations;
    use WithFaker;

    /**
     * @test *
     * When user submits post request to create item endpoint
     *
     * @return void
     */
    public function users_can_create_a_new_item()
    {
        $data =  [
            'name' => $this->faker->word
        ];
        $response = $this->postJson('/api/items',$data);
        $response->assertStatus(200);
        //We considered '200' for the success operation
        $sucessCode = $response->decodeResponseJson()['code'];
        $this->assertEquals(200, $sucessCode);
    }

    /**
     * @test *
     * Test Validation
     *
     * @return void
     */
    public function users_cannot_create_a_new_item()
    {
        $data =  [
            'name' => ''
        ];
        $response = $this->postJson('/api/items',$data);
        $response->assertStatus(200);
        //We considered '200' for success operation
        $sucessCode = $response->decodeResponseJson()['code'];
        $this->assertEquals(101, $sucessCode);
    }
}
