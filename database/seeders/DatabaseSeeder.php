<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Category;
use App\Models\Customer;
use App\Models\InvoiceItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::factory()->create([
            'name' => 'raito',
            'email' => 'raito@raito.com',
            'password' => Hash::make('raito')
        ]);

        Category::factory(5)->create();
        Customer::factory(5)->create();
        Invoice::factory(5)->create();
        InvoiceItem::factory(5)->create();
    }
}