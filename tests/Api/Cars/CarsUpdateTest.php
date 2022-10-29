<?php

namespace Tests\Api\Cars;

use Tests\TestCase;

class CarsUpdateTest extends TestCase
{

    public function testUnAuthorized()
    {

        $response = $this->putJson('/api/v1/cars/1', ['title' => '']);
        $response->assertStatus(401);
    }

    public function testEmptyTitle()
    {
        $response = $this->putJson('/api/v1/cars/1', ['title' => ''], $this->authHeaders());

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
        $response = $this->putJson('/api/v1/cars/1', ['title' => 'Toyota Land Cruiser'], $this->authHeaders());

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
