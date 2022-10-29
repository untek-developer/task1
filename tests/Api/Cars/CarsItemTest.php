<?php

namespace Tests\Api\Cars;

use Tests\TestCase;

class CarsItemTest extends TestCase
{

    public function testUnAuthorized()
    {
        $response = $this->getJson('/api/v1/cars/1');
        $response->assertStatus(401);
    }

    public function testItem1()
    {
        $response = $this->get('/api/v1/cars/1', $this->authHeaders());
        $response->assertStatus(200);
        $response->assertJson([
            "id" => 1,
            "title" => "Hyundai Solaris",
            "user_id" => null,
        ]);
    }

    public function testItem2()
    {
        $response = $this->get('/api/v1/cars/2', $this->authHeaders());
        $response->assertStatus(200);
        $response->assertJson([
            "id" => 2,
            "title" => "Toyota Camry",
            "user_id" => null,
        ]);
    }

    public function testNotFoundItem()
    {
        $response = $this->get('/api/v1/cars/2222', $this->authHeaders());
        $response->assertStatus(404);
    }
}
