<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory(App\Entities\User::class)->create([
            'name' => 'Rodolfo',
            'email' => 'rodolfofrancisco1990@gmail.com',
            'password' => bcrypt(123456),
            'remember_token' => str_random(10),
        ]);

        factory(\App\Entities\User::class, 30)->create();
        // $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
