<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        factory(App\Models\User::class, 20)->create()->each(function($user) {
            $user->channel()->save(factory(App\Models\Channel::class)->make());
        });
    }
}
