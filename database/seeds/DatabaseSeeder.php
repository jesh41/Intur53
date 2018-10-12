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
        $this->call(catmestableseeder::class);
          $this->call(regionseeder::class);
          $this->call(catsex::class);
         $this->call(catreason::class);
         $this->call(activity::class);
        $this->call(category::class);
    }
}
