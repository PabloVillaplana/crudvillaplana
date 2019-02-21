<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModuleTest extends TestCase

{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @test
     */
    function it_show_the_users_list()
    {
        factory(User::class)->create([
            'name' => 'Brandon'
        ]);

        factory(User::class)->create([
            'name' => 'Juan'
        ]);

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Listado de Usuarios')
            ->assertSee('Brandon')
            ->assertSee('Juan'); //Valores del return //Valores del return

    }

    /**
     * A basic test example.
     *
     * @test
     */
    function it_shows_a_default_message_if_users_list_is_empty()
    {
//        DB::table('users')->truncate();

        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('No hay USUARIOS REGISTRADOS'); //Valores del return //Valores del return

    }

    /**
     * A basic test example.
     *
     * @test
     */

    function it_display_the_users_details_page()
    {

        $user = factory(User::class)->create([
            'name' => 'Juan Pablo'
        ]);


        $this->get('/usuarios/' . $user->id)
            ->assertStatus(200)
            ->assertSee('Juan Pablo');

    }


    /**
     * A basic test example.
     *
     * @test
     */

    function it_display_a_404_error_if_the_user_is_not_found()
    {
        $this->get('/usuarios/999')
            ->assertStatus(404)
            ->assertSee('Pagina no encontrado');
    }


    /**
     * A basic test example.
     *
     * @test
     */

    function it_loads_the_users_new_details_page()
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Crear Usuario'); //Valores del return
    }

    /**
     * A basic test example.
     *
     * @test
     */

    function it_create_a_new_user()
    {

        $this->withExceptionHandling();

        $this->post('/usuarios/', [
            'name' => 'Juan Pablo',
            'email' => 'jpvillaplana@bamboo.cr',
            'password' => '123456'
        ])->assertRedirect('/usuarios/');

        $this->assertCredentials([
            'name' => 'Juan Pablo',
            'email' => 'jpvillaplana@bamboo.cr',
            'password' => '123456'
        ]);
    }


    /**  @test * */

    function it_name_is_requerid()
    {

        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => '',
                'email' => 'jpvillaplana@bamboo.cr',
                'password' => '123456'
            ])
            ->assertRedirect('/usuarios/nuevo')
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);


        $this->assertEquals(0, User::count());
    }

    /**  @test * */
    function it_email_is_requerid()
    {

        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Juan',
                'email' => '',
                'password' => '123456'
            ])
            ->assertRedirect('/usuarios/nuevo')
            ->assertSessionHasErrors(['email']);


        $this->assertEquals(0, User::count());
    }


    /**  @test * */
    function the_email_must_be_valid()
    {

        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Juan',
                'email' => 'correo-no-valido',
                'password' => '123456'
            ])
            ->assertRedirect('/usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

    }


    /**  @test * */
    function the_email_must_be_unique()
    {
        factory(User::class)->create([
            'email' => 'jpvillaplana@bamboo.cr'
        ]);

        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Juan',
                'email' => 'jpvillaplana@bamboo.cr',
                'password' => '123456'
            ])
            ->assertRedirect('/usuarios/nuevo')
            ->assertSessionHasErrors(['email']);


        $this->assertEquals(1, User::count());
    }

    /**  @test * */

    function it_password_is_requerid()
    {

        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Juan',
                'email' => 'jpvillaplana@bamboo.cr',
                'password' => ''
            ])
            ->assertRedirect('/usuarios/nuevo')
            ->assertSessionHasErrors(['password']);


        $this->assertEquals(0, User::count());
    }



    /**
     * A basic test example.
     *
     * @test
     */

    function it_loads_the_new_edit_user_page()
    {
        $user =factory(User::class)->create();

        $this->get("/usuarios/$user->id/editar")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertViewHas('user', function ($viewUser) use ($user){
                return $viewUser -> id == $user->id;
            });
    }


    /**
     * A basic test example.
     *
     * @test
     */

    function it_update_a_user()
    {
        $user =factory(User::class)->create();


        $this->put("/usuarios/{$user->id}", [
            'name' => 'Pablo',
            'email' => 'jpvillaplana@gmail.com',
            'password' => '123456789'
        ])->assertRedirect("/usuarios/{$user->id}");

        $this->assertCredentials([
            'name' => 'Pablo',
            'email' => 'jpvillaplana@gmail.com',
            'password' => '123456789'
        ]);
    }


    /**  @test * */
    function the_name_is_requerid_when_updating_a_user()
    {
        $user = factory(User::class)->create();

        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
                'name' => '',
                'email' => 'jpvillaplana@bamboo.cr',
                'password' => '123456'
            ])
            ->assertRedirect("/usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['name']);


        $this->assertDatabaseMissing('users', ['email' => 'jpvillaplana@gmail.com']);
    }
//
////    HOLAAAAAAAAAAAAAAAAAA

    /**  @test * */
    function the_email_must_be_valid_when_updating_the_user()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Juan',
                'email' => 'correo-no-valido',
                'password' => '123456'
            ])
            ->assertRedirect("/usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);


        $this->assertDatabaseMissing('users', ['name' => 'Juan']);

    }
    /**  @test * */
    function the_email_must_be_unique_when_updating_the_user()
    {

        factory(User::class)->create([
            'email' => 'existing_email@example.com'
        ]);

        $user = factory(User::class)->create([
            'email' => 'jpvillaplana@gmail.com'
        ]);

        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Juan',
                'email' => 'existing_email@example.com',
                'password' => '123456'
            ])
            ->assertRedirect("/usuarios/{$user->id}/editar")
            ->assertSessionHasErrors(['email']);


    }

    /**  @test * */
    function it_email_can_stay_the_same_when_updating_the_user()
    {

        $user = factory(User::class)->create([
            'email'=> 'jpvillaplana@gmail.com'
        ]);

        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Juan',
                'email' => 'jpvillaplana@gmail.com',
                'password' => '1235'
            ])
            ->assertRedirect("/usuarios/{$user->id}");


        $this->assertDatabaseHas('users',[
            'name'=> 'Juan',
            'email' => 'jpvillaplana@gmail.com'
        ]);


    }

    /**  @test * */
    function it_password_is_optional_updating_the_user()
    {

        $oldPassword = 'CLAVE_ANTERIOR';

        $user = factory(User::class)->create([
            'password'=> bcrypt($oldPassword)
        ]);

        $this->from("/usuarios/{$user->id}/editar")
            ->put("/usuarios/{$user->id}", [
                'name' => 'Juan',
                'email' => 'jpvillaplana@gmail.com',
                'password' => ''
            ])
            ->assertRedirect("/usuarios/{$user->id}");


        $this->assertCredentials([
            'name'=> 'Juan',
            'email' => 'jpvillaplana@gmail.com',
            'password' => $oldPassword
        ]);


    }


    /**@test **/
    function  it_delete_a_user()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();

        $this->delete("usuarios/{$user->id}")
            ->assertRedirect('usuarios');

        $this->assertDatabaseMissing('users',[
            'id' => $user->id
        ]);

//        $this->assertSame(0, User::count());
    }



}

