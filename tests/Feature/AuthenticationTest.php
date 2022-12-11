<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Seed the Permission Data
        $this->seed(PermissionSeeder::class);
    }

    public function test_login_screen_can_be_rendered()
    {
        $response = $this->get('app/login');

        $response->assertStatus(200);
    }

    public function test_a_customer_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();
        $user->assignRole('customer');
        $response = $this->post(route('app.login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);


        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::CUSTOMER_HOME);
    }

    public function test_an_admin_can_authenticate_using_the_login_screen()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');
        $response = $this->post(route('app.login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);


        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_users_can_not_authenticate_with_invalid_password()
    {
        $user = User::factory()->create();

        $this->post(route('app.login'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
