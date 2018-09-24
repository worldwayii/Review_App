<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ManufacturersTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
    }
}
