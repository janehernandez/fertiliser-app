<?php

namespace Tests\Feature\Customer;

use App\Models\Product;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(PermissionSeeder::class);
        $this->actingAsCustomer();
    }

    public function test_customer_home_screen_can_be_rendered()
    {
        $response = $this->get('app/customer/home');
        $response->assertStatus(200)->assertOk();
    }

    public function test_customer_can_see_home_screen_with_products()
    {
        $products = Product::factory()->count(10)->create();
        $this->get(route('app.customer.home'))
            ->assertPropCount('products.data', 10);
    }

    public function test_an_admin_cannot_view_home_screen()
    {
        $this->actingAsAdmin();
        $response = $this->get('app/customer/home');
        $response->assertStatus(403)->assertForbidden();
    }
}
