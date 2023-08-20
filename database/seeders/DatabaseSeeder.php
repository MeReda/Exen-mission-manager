<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Group::factory(2)->create();
        \App\Models\User::factory(11)->create();
        \App\Models\Mission::factory(30)->create();
        \App\Models\Expense::factory(50)->create();
    }
}
