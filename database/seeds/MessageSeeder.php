<?php

use Illuminate\Database\Seeder;
use App\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->delete();

        Message::create(array(
            'dateCreation' => Carbon\Carbon::now()->toDateString(),
            'text' => 'blabla',
            'idAuthor' => 1,
            'idTopic' => 1,
        ));
        Message::create(array(
            'dateCreation' => Carbon\Carbon::now()->toDateString(),
            'text' => 'Lorem ipsum dolor sit amet',
            'idAuthor' => 2,
            'idTopic' => 1,
        ));
        Message::create(array(
            'dateCreation' => Carbon\Carbon::now()->toDateString(),
            'text' => 'blabla',
            'idAuthor' => 1,
            'idTopic' => 1
        ));
        Message::create(array(
            'dateCreation' => Carbon\Carbon::now()->toDateString(),
            'text' => 'blabla',
            'idAuthor' => 1,
            'idTopic' => 2,
        ));
        Message::create(array(
            'dateCreation' => Carbon\Carbon::now()->toDateString(),
            'text' => 'Lorem ipsum dolor sit amet',
            'idAuthor' => 2,
            'idTopic' => 2,
        ));
        Message::create(array(
            'dateCreation' => Carbon\Carbon::now()->toDateString(),
            'text' => 'blabla',
            'idAuthor' => 1,
            'idTopic' => 2,
        ));
    }
}
