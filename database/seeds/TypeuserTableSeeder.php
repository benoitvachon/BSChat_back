<?php

use Illuminate\Database\Seeder;
use App\Typeuser;

class TypeuserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('typeuser')->delete();
        
        Typeuser::create(array(
          'type' => 'Etudiant'
      ));
        
        Typeuser::create(array(
          'type' => 'Professeur'
      ));
    }
}
