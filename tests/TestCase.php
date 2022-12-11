<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Arr;
use Illuminate\Testing\Assert;
use Illuminate\Testing\TestResponse;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        TestResponse::macro('props', function ($key = null) {
            $props = json_decode(json_encode($this->original->getData()['page']['props']), JSON_OBJECT_AS_ARRAY);

            if ($key) {
                return Arr::get($props, $key);
            }

            return $props;
        });

        TestResponse::macro('assertHasProp', function ($key) {
            Assert::assertTrue(Arr::has($this->props(), $key));

            return $this;
        });

        TestResponse::macro('assertPropValue', function ($key, $value) {
            $this->assertHasProp($key);

            if (is_callable($value)) {
                $value($this->props($key));
            } else {
                Assert::assertEquals($this->props($key), $value);
            }

            return $this;
        });

        TestResponse::macro('assertPropCount', function ($key, $count) {
            $this->assertHasProp($key);

            Assert::assertCount($count, $this->props($key));

            return $this;
        });
    }

    // to call admin on each test cases
    protected function actingAsAdmin()
    {
        return $this->actingAs(User::factory()->create()->assignRole('admin'));
    }

    // to call customer on each test cases
    protected function actingAsCustomer($user = null)
    {
        return $this->actingAs($user ?? User::factory()->create()->assignRole('customer'));
    }
}
