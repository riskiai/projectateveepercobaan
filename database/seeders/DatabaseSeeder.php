<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat roles
        $roles = ['Admin', 'User', 'Admin Master'];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }

        // Buat Admin biasa
        User::factory()->create([
            'email' => 'admin@mailinator.com',
            'role_id' => Role::ADMIN,
            'name' => 'Admin'
        ]);

        // Buat Admin Master
        User::factory()->create([
            'email' => 'adminmaster@mailinator.com',
            'role_id' => Role::ADMIN_MASTER,
            'name' => 'Admin Master'
        ]);

        $this->call([
            PurchaseCategorySeeder::class,
            PurchaseStatusSeeder::class,
            ContactTypeSeeder::class,
        ]);
    }
}
