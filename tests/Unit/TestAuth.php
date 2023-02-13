<?php

namespace Tests\Unit;

use Tests\TestCase;

class TestAuth extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_user_can_login()
    {
        $userCredentials = [
            'email' => "abhishek@abhishek.com",
            'password' => 'Admin12345'
        ];

        $response = $this->postJson('login', $userCredentials);

        $response->assertStatus(204);
    }
}
