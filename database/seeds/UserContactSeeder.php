<?php

use Illuminate\Database\Seeder;
use App\Usercontact;

class UserContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usercontact')->delete();

        Usercontact::create(array(
            'user1' => 3,
            'user2' => 1,
            'valid' => true,
            'idTopic' => 6
        ));
        Usercontact::create(array(
            'user1' => 1,
            'user2' => 2,
            'valid' => true,
            'idTopic' => 7
        ));
        Usercontact::create(array(
            'user1' => 2,
            'user2' => 3,
            'valid' => true,
            'idTopic' => 8
        ));
    }
}
