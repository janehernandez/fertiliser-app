<?php

namespace Tests\Feature\Admin\Product;

use App\Models\Product;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(PermissionSeeder::class);
        $this->actingAsAdmin();
    }

    public function test_admin_can_store_product()
    {
        $payload = Product::factory()->make()->toArray();

        $this->postJson(route('app.product.store'), $payload);

        $this->assertEquals(1, Product::count());
    }

    /**
     * @test
     * @dataProvider validationProvider
     */
    // public function verify_validation($payload, $key)
    // {
    //     $user = $this->actingAsCustomer();

    //     $this->postJson(route('customer.bio-datas.store'), $payload())
    //         ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    // }

    // public function validationProvider()
    // {
    //     $fields = [
    //         'first_name',
    //         'last_name',
    //         'birthdate',
    //         'gender',
    //         'nationality',
    //         'civil_status',
    //         'mobile_number',
    //         'phone_number',
    //         'current_address',
    //     ];

    //     $testCase = [];

    //     foreach ($fields as $key) {
    //         $testCase['missing_' . $key] = [
    //             'payload' => function () use ($key) {
    //                 $defaultPayload = BioData::factory()->raw();
    //                 Arr::except($defaultPayload, 'user_id');
    //                 return Arr::except($defaultPayload, $key);
    //             },
    //             'key' => $key
    //         ];
    //     }

    //     yield from $testCase;
    // }
}
