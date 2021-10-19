<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_register()
    {
        $this->postJson(route('user.register'),[
            'name' => "Marcos",
            'email' => 'marcos@marcos.com',
            'password' => '123123123',
            'password_confirmation' => '123123123',
        ])->assertCreated();

        $this->assertDatabaseHas('users',['name' => 'Marcos']);
    }
}