<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::statement('SET FOREIGN_KEY_CHECKS=0');
       DB::table('items')->delete();
       DB::table('items')->truncate();

       DB::table('items')->insert(array(
            array(
                'id' => '1',
                'name' => 'Modern Chair',
                'sku' => 'modenchair2838',
                'url' => 'www.newestdesign.org',
                'manufacturer_id' => '1',
                'about' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
                'price' => '120',
            ),
           array(
                'id' => '2',
                'name' => 'Minimalistic Plant Pot',
                'sku' => 'minimalplant1038',
                'manufacturer_id' => '2',
                'url' => 'www.newestdesign.org',
                'about' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
                'price' => '190',
            ),
           array(
                'id' => '3',
                'name' => 'Vague Chair',
                'sku' => 'vaguechair8438',
                'manufacturer_id' => '3',
                'url' => 'www.newestdesign.org',
                'about' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
                'price' => '220',
            ),
           array(
                'id' => '4',
                'name' => 'Night Stand',
                'sku' => 'nightstand2028',
                'manufacturer_id' => '4',
                'url' => 'www.newestdesign.org',
                'about' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
                'price' => '420',
            ),
           array(
                'id' => '5',
                'name' => 'Plant Pot',
                'sku' => 'plantpot0938',
                'manufacturer_id' => '5',
                'url' => 'www.accentdesigns.uk',
                'about' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
                'price' => '320',
            ),
           array(
                'id' => '6',
                'name' => 'Small Table',
                'sku' => 'smalltable8594',
                'manufacturer_id' => '6',
                'url' => 'www.accentdesigns.uk',
                'about' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
                'price' => '620',
            ),
           array(
                'id' => '7',
                'name' => 'Metallic Chair',
                'sku' => 'metallicchair9794',
                'manufacturer_id' => '7',
                'url' => 'www.accentdesigns.uk',
                'about' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
                'price' => '410',
            ),
           array(
                'id' => '8',
                'name' => 'Modern Rocking Chair',
                'sku' => 'moderocchair1294',
                'manufacturer_id' => '8',
                'url' => 'www.accentdesigns.uk',
                'about' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
                'price' => '730',
            ),
           array(
                'id' => '9',
                'name' => 'Bang Olufsen',
                'sku' => 'bangolufsen8014',
                'manufacturer_id' => '9',
                'url' => 'www.accentdesigns.uk',
                'about' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!",
                'price' => '520',
            )

        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
