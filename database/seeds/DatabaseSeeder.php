<?php

use Illuminate\Database;
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

                  factory(App\User::class, 1)->create([
                    'first_name' => "John",
                     'last_name' => "Doe",
                    'email' => "test@test.com",
                    'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
                    'remember_token' => Str::random(10),

                ]);

// Auto generate 10 accounts
        factory(App\User::class, 50)->create();
        factory(App\Checkout::class, 100)->create();
       // To avoid occurrence  && concurrency creation , use step by step creation (for) ,
        // FIFO access DB ;
//        Number of creatin referal must be less of number of user creation.
        for($i=0; $i < 40; $i++)
            factory(App\Referral::class, 1)->create();
//        $this->clean();
    }
}
