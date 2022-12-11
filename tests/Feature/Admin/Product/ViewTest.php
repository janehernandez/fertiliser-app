<?php

namespace Tests\Feature\Customer\Product;

use App\Models\Product;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(PermissionSeeder::class);
        $this->actingAsAdmin();
    }

    public function test_admin_can_see_product_screen()
    {
        $response = $this->get(route('app.product.index'));
        $response->assertStatus(200)->assertOk();
    }

    public function test_admin_can_see_product_screen_with_products()
    {
        $products = Product::factory()->count(10)->create();
        $this->get(route('app.product.index'))
            ->assertPropCount('products.data', 10);
    }

    public function test_a_customer_cannot_view_dashboard_screen()
    {
        $this->actingAsCustomer();
        $response = $this->get(route('app.product.index'));
        $response->assertStatus(403)->assertForbidden();
    }
}
