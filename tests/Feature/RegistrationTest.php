<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Seed the Permission Data
        $this->seed(PermissionSeeder::class);
    }

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get(route('app.register'));
        $response->assertStatus(200);
    }

    public function test_new_customer_can_register()
    {
        $response = $this->post(route('app.register'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);

        $user = User::whereEmail('test@example.com')->first();
        $user->assignRole('customer');

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::CUSTOMER_HOME);
    }
}
