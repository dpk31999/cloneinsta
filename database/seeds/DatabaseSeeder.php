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
        // $this->call(UserTableSeeder::class);
        $this->call(MessageTableSeeder::class);
        // $this->call(StudentsTableSeeder::class);
        // $this->call(PostsSeeder::class);
        // $this->call(RolesTableSeeder::class);
        // $this->call(UserTableSeeder::class);
    }
}
