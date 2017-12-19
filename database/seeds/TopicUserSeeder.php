<?php

use Illuminate\Database\Seeder;
use App\TopicUser;

class TopicUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topicuser')->delete();
        
        TopicUser::create(array(
          'idTopic' => 1,
          'idUser' => 1,
      ));   TopicUser::create(array(
          'idTopic' => 1,
          'idUser' => 2,
      ));   TopicUser::create(array(
          'idTopic' => 2,
          'idUser' => 3,
      ));   TopicUser::create(array(
          'idTopic' => 3,
          'idUser' => 1,
      ));   TopicUser::create(array(
          'idTopic' => 4,
          'idUser' => 2,
      ));   TopicUser::create(array(
          'idTopic' => 5,
          'idUser' => 4,
      ));   TopicUser::create(array(
          'idTopic' => 3,
          'idUser' => 4,
      ));   TopicUser::create(array(
          'idTopic' => 2,
          'idUser' => 2,
      ));   
    }
}
