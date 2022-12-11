<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::factory()->create([
            'email' => 'customer@customer.com',
            'password' => bcrypt('password')
        ]);
        $adminUser->assignRole('customer');
    }
}
