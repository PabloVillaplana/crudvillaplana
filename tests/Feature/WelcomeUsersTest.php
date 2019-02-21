<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    function it_welcome_users_without_nickname(){
        $this->get('/saludo/Juan')
            ->assertStatus(200)
            ->assertSee('Bienvenido Juan, tu no tienes apodo'); //Valores del return
    }

    /**
     * A basic test example.
     *
     * @test
     */

    function it_welcome_users_with_nickname(){
        $this->get('/saludo/Juan/Villa')
            ->assertStatus(200)
            ->assertSee('Bienvenido Juan'); //Valores del return
    }

}

