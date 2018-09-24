<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::statement('SET FOREIGN_KEY_CHECKS=0');
       DB::table('roles')->delete();
       DB::table('roles')->truncate();

       DB::table('roles')->insert(array(

            array(
                'id' => '1',
                'name' => 'Regular',
            ),
            array(
                'id' => '2',
                'name' => 'Moderator',
            )

 		));
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
