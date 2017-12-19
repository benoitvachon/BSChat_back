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
        Eloquent::unguard();
        $this->call('TypeuserTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('TopicSeeder');
        $this->call('MessageSeeder');
        $this->call('UserContactSeeder');
        $this->call('TopicUserSeeder');
    }
}
