<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function authHeaders(): array {
        return [
            'Authorization' => 'Bearer wnxnNrP/buVMxe1miiQ8w.JXBrhOC5zeMuYUTNAjZV.MySSA80yTG',
        ];
    }
}
