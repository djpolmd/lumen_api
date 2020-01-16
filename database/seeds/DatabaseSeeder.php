<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Default admin user uncomment on first seeding   ;

//          factory(App\User::class, 1)->create([
//            'name' => "John Doe",
//            'email' => "test@test.com",
//            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
//            'remember_token' => Str::random(10),
//
//        ]);

// Auto generate 10 accounts
        factory(App\User::class, 10)->create();
        factory(App\Checkout::class, 40)->create();
    }
}
