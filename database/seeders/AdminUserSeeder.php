<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
        $adminUser->assignRole('admin');
    }
}
