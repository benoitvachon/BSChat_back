<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table) {
		$table->increments('id');
		$table->string('login', 100);
                $table->string('name', 100);
                $table->string('email', 100);
                $table->string('password', 100);
                $table->text('remember_token', 512);
               
                $table->integer('idtype')->unsigned();
                $table->foreign('idtype')->references('id')->on('typeuser');
	});
        
        Schema::table('users', function (Blueprint $table) {
              $table->text('remember_token', 512)->nullable()->change();
              $table->text('remember_token', 512)->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
