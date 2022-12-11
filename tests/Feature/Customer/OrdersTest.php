<?php

namespace Tests\Feature\Customer;

use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(PermissionSeeder::class);
        $this->actingAsCustomer();
    }

    public function test_customers_order_page_can_be_rendered()
    {
        $response = $this->get(route('app.customer.orders.index'));
        $response->assertStatus(200)->assertOk();
    }

    public function test_an_admin_cannot_view_order_page()
    {
        $this->actingAsAdmin();
        $response = $this->get(route('app.customer.orders.index'));
        $response->assertStatus(403)->assertForbidden();
    }
}
