<?php

namespace Tests\Feature\Customer;

use App\Models\LogOrderTransaction;
use App\Models\Product;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(PermissionSeeder::class);
        $this->actingAsAdmin();
    }

    public function test_admin_dashboard_screen_can_be_rendered()
    {
        $response = $this->get('app/dashboard');
        $response->assertStatus(200)->assertOk();
    }

    public function test_admin_can_see_dashboard_screen_with_transactions()
    {
        $logOrders = LogOrderTransaction::factory()->count(10)->create();
        $this->get(route('app.dashboard'))
            ->assertPropCount('logOrders.data', 10);
    }

    public function test_a_customer_cannot_view_dashboard_screen()
    {
        $this->actingAsCustomer();
        $response = $this->get('app/dashboard');
        $response->assertStatus(403)->assertForbidden();
    }
}
