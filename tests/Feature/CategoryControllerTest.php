<?php

namespace App\panour\tests\Feature;

use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;

class CategoryControllerTest extends TestCase
{
    /** @test */
    public function it_retrieves_all_index_data()
    {
        $response = $this->json('GET', '/api/categories');

        $response
            ->assertSuccessful()
            ->assertJson(fn (AssertableJson $json) =>
                $json->has('data', 6, fn ($json) =>
                    $json->where('id', 1)
                        ->where('name', 'Food')
                )
            );
        $this->assertDatabaseCount('categories', 6);
        $this->assertDatabaseHas('categories', [
            'name' => 'Food'
        ]);
    }
}
