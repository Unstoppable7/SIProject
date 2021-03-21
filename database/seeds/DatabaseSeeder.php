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
        factory(App\Audit::class, 31)->create();

        App\User::create([
            'name' => 'Cristian Rosales',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);

        factory(App\Company::class, 10)->create();
        //factory(App\Product::class, 20)->create();
    }
}
