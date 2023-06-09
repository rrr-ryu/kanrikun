<?php

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
        $this->call(
            [
                UserSeeder::class,
                CompanySeeder::class,
                // ProductSeeder::class,
            ]
        );
        factory(App\Models\Product::class, 20)->create();
    }
}
