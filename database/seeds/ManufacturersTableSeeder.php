<?php

use Illuminate\Database\Seeder;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::statement('SET FOREIGN_KEY_CHECKS=0');
       DB::table('manufacturers')->delete();
       DB::table('manufacturers')->truncate();

       DB::table('manufacturers')->insert(array(
            array(
                'id' => '1',
                'name' => 'Vimanco',
                'sku' => 'vimanco-m-a1',
            ),
           array(
                'id' => '2',
                'name' => 'Nebosh',
                'sku' => 'neboas-m-a2',
            ),
           array(
                'id' => '3',
                'name' => 'Webosh',
                'sku' => 'weboas-m-a3',
            ),
           array(
                'id' => '4',
                'name' => 'Nonso',
                'sku' => 'nonso-m-a4',
            ),
           array(
                'id' => '5',
                'name' => 'Poolky',
                'sku' => 'poolky-m-a5',
            ),
           array(
                'id' => '6',
                'name' => 'Samba',
                'sku' => 'samba-m-a6',
            ),
           array(
                'id' => '7',
                'name' => 'Sioyotek',
                'sku' => 'sioyotek-m-a7',
            ),
           array(
                'id' => '8',
                'name' => 'Diamond',
                'sku' => 'diamond-m-a8',
            ),
           array(
                'id' => '9',
                'name' => 'Omalicha',
                'sku' => 'omalicha-m-a9',
            )
        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
