<?php

namespace Tests\Api\Cars;

use Tests\TestCase;

class CarsCreateTest extends TestCase
{

    public function testUnAuthorized()
    {
        $response = $this->postJson('/api/v1/cars', ['title' => '']);
        $response->assertStatus(401);
    }

    public function testEmptyTitle()
    {
        $response = $this->postJson('/api/v1/cars', ['title' => ''], $this->authHeaders());

        $response->assertStatus(422);
        $response->assertJson([
            "message" => "Validation error!",
            "errors" => [
                "title" => [
                    "The title field is required."
                ]
            ]
        ]);
    }

    public function testExistsTitle()
    {
        $response = $this->postJson('/api/v1/cars', ['title' => 'Toyota Land Cruiser'], $this->authHeaders());

        $response->assertStatus(422);
        $response->assertJson([
            "message" => "Validation error!",
            "errors" => [
                "title" => [
                    "The title has already been taken."
                ]
            ]
        ]);
    }

}
