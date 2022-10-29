<?php

namespace Tests\Feature;

use Tests\TestCase;

class CarsTest extends TestCase
{

    public function testAll()
    {
        $headers = [
            'Authorization' => 'Bearer wnxnNrP/buVMxe1miiQ8w.JXBrhOC5zeMuYUTNAjZV.MySSA80yTG',
        ];
        $response = $this->get('/api/v1/cars', $headers);

        $response->assertStatus(200);
        $response->assertHeader('X-Pagination-Total-Count', 4);
        $response->assertHeader('X-Pagination-Current-Page', 1);
        $response->assertHeader('X-Pagination-Per-Page', 15);

//        dd(json_decode($response->getContent()));

        $response->assertJsonCount(4);
        $response->assertJson([
            [
                "id" => 1,
                "title" => "Hyundai Solaris",
                "user_id" => null,
                "created_at" => "2022-10-29T14:32:47.000000Z",
                "updated_at" => "2022-10-29T14:32:47.000000Z",
            ],
            [
                "id" => 2,
                "title" => "Toyota Camry",
                "user_id" => null,
                "created_at" => "2022-10-29T14:32:47.000000Z",
                "updated_at" => "2022-10-29T14:32:47.000000Z",
            ],
            [
                "id" => 3,
                "title" => "Toyota Land Cruiser",
                "user_id" => null,
                "created_at" => "2022-10-29T14:32:47.000000Z",
                "updated_at" => "2022-10-29T14:32:47.000000Z",
            ],
            [
                "id" => 4,
                "title" => "Toyota Mark II",
                "user_id" => null,
                "created_at" => "2022-10-29T14:32:47.000000Z",
                "updated_at" => "2022-10-29T14:32:47.000000Z",
            ],
        ]);
    }
}
