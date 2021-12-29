<?php

namespace App\panour\tests\Feature;

use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class CityControllerTest extends TestCase
{
    /** @test */
    public function it_retrieves_all_index_data()
    {
        $response = $this->json('GET', '/api/cities');

        $response
            ->assertSuccessful()
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('data', 6, fn ($json) =>
                $json->where('id', 1)
                    ->where('name', 'Tokyo')
            )
        );
        $this->assertDatabaseCount('cities', 6);
        $this->assertDatabaseHas('cities', [
            'name' => 'Tokyo'
        ]);
    }
}
