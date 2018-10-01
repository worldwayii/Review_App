<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
       DB::statement('SET FOREIGN_KEY_CHECKS=0');
       DB::table('images')->delete();
       DB::table('images')->truncate();

       DB::table('images')->insert(array(
            array(
                'id' => '1',
                'item_id' => '1',
                'path' => '1.jpg'
            ),
           array(
                'id' => '2',
                'item_id' => '2',
                'path' => '2.jpg'
            ),
           array(
                'id' => '3',
                'item_id' => '3',
                'path' => '3.jpg'
            ),
           array(
                'id' => '4',
                'item_id' => '4',
                'path' => '4.jpg'
            ),
           array(
                'id' => '5',
                'item_id' => '5',
                'path' => '5.jpg'
            ),
           array(
                'id' => '6',
                'item_id' => '6',
                'path' => '6.jpg'
            ),
           array(
                'id' => '7',
                'item_id' => '7',
                'path' => '7.jpg'
            ),
           array(
                'id' => '8',
                'item_id' => '8',
                'path' => '8.jpg'
            ),
           array(
                'id' => '9',
                'item_id' => '9',
                'path' => '9.jpg'
            )

        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
