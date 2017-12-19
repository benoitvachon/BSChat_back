<?php

use Illuminate\Database\Seeder;
use App\Topic;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->delete();
        
        Topic::create(array(
          'dateCreation' => Carbon\Carbon::now()->toDateString(),
          'nom' => 'Maths',
          'idAdmin' => 1 
      ));       
        Topic::create(array(
          'dateCreation' => Carbon\Carbon::now()->toDateString(),
          'nom' => 'Histoire',
          'idAdmin' => 3
      ));
        Topic::create(array(
          'dateCreation' => Carbon\Carbon::now()->toDateString(),
          'nom' => 'Science Physique',
          'idAdmin' => 1 
      ));
        Topic::create(array(
          'dateCreation' => Carbon\Carbon::now()->toDateString(),
          'nom' => 'Anglais',
          'idAdmin' => 2 
      ));
        Topic::create(array(
          'dateCreation' => Carbon\Carbon::now()->toDateString(),
          'nom' => 'Base de données',
          'idAdmin' => 4
      ));
        Topic::create(array(
            'dateCreation' => Carbon\Carbon::now()->toDateString(),
            'nom' => 'Contact',
            'idAdmin' => 3
        ));
        Topic::create(array(
            'dateCreation' => Carbon\Carbon::now()->toDateString(),
            'nom' => 'Contact',
            'idAdmin' => 1
        ));
        Topic::create(array(
            'dateCreation' => Carbon\Carbon::now()->toDateString(),
            'nom' => 'Contact',
            'idAdmin' => 2
        ));
    }
}
