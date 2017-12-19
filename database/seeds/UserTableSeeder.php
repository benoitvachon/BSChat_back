<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        
        User::create(array(
          'login' => 'johnny',
          'name' => 'John Doe',
          'email' => 'johnmail@yopmail.com',
          'password' => Hash::make('studycom'),
          'remember_token' => '',
          'idtype' => 1
      ));
        
        User::create(array(
          'login' => 'Jimmy',
          'name' => 'Jim Sobieski',
          'email' => 'sobieskimail@yopmail.com',
          'password' => Hash::make('studycom'),
          'remember_token' => '',
          'idtype' => 1
      ));
        
        User::create(array(
          'login' => 'Mamad',
          'name' => 'Mamdadou Sakho',
          'email' => 'sakhomail@yopmail.com',
          'password' => Hash::make('studycom'),
          'remember_token' => '',
          'idtype' => 1
      ));
        
        User::create(array(
          'login' => 'Gege',
          'name' => 'Gerard LeProf',
          'email' => 'profmail@yopmail.com',
          'password' => Hash::make('studycom'),
          'remember_token' => '',
          'idtype' => 2
      ));
    }
}
