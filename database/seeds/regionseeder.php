<?php

use Illuminate\Database\Seeder;

class regionseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $array=array("Norte America","Centro America","Sur America","El Caribe","Europa","Asia","Africa","Oceania");

    	for($i=0;$i<8;$i++){
            DB::table('region')->insert([
                'region' => $array[$i],
            ]);
        }
    }
}
