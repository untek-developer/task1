<?php

namespace Tests\Api\Cars;

use Tests\TestCase;

class CarsListTest extends TestCase
{

    public function testUnAuthorized()
    {
        $response = $this->getJson('/api/v1/cars');
        $response->assertStatus(401);
    }

    public function testAll()
    {
        $response = $this->get('/api/v1/cars', $this->authHeaders());

        $response->assertStatus(200);
        $response->assertHeader('X-Pagination-Total-Count', 4);
        $response->assertHeader('X-Pagination-Current-Page', 1);
        $response->assertHeader('X-Pagination-Per-Page', 15);

        $response->assertJsonCount(4);
        $response->assertJson([
            [
                "id" => 1,
                "title" => "Hyundai Solaris",
                "user_id" => null,
            ],
            [
                "id" => 2,
                "title" => "Toyota Camry",
                "user_id" => null,
            ],
            [
                "id" => 3,
                "title" => "Toyota Land Cruiser",
                "user_id" => null,
            ],
            [
                "id" => 4,
                "title" => "Toyota Mark II",
                "user_id" => null,
            ],
        ]);
    }

    public function testPaginate()
    {
        $response = $this->get('/api/v1/cars?limit=2&page=2', $this->authHeaders());

        $response->assertStatus(200);
        $response->assertHeader('X-Pagination-Total-Count', 4);
        $response->assertHeader('X-Pagination-Current-Page', 2);
        $response->assertHeader('X-Pagination-Per-Page', 2);

        $response->assertJsonCount(2);
        $response->assertJson([
            [
                "id" => 3,
                "title" => "Toyota Land Cruiser",
                "user_id" => null,
            ],
            [
                "id" => 4,
                "title" => "Toyota Mark II",
                "user_id" => null,
            ],
        ]);
    }

    public function testPaginatePage2()
    {
        $response = $this->get('/api/v1/cars?page=2', $this->authHeaders());

        $response->assertStatus(200);
        $response->assertHeader('X-Pagination-Total-Count', 4);
        $response->assertHeader('X-Pagination-Current-Page', 2);
        $response->assertHeader('X-Pagination-Per-Page', 15);

        $response->assertJsonCount(0);
    }
}
