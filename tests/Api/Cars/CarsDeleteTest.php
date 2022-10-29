<?php

namespace Tests\Api\Cars;

use Tests\TestCase;

class CarsDeleteTest extends TestCase
{

    public function testUnAuthorized()
    {
        $response = $this->deleteJson('/api/v1/cars/2222');
        $response->assertStatus(401);
    }

    public function testNotFound()
    {
        $response = $this->deleteJson('/api/v1/cars/2222', [], $this->authHeaders());
        $response->assertStatus(404);
    }
}
