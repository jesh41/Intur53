<?php

use Illuminate\Database\Seeder;

class catsex extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $array=array("F","M");

    	for($i=0;$i<2;$i++){
            DB::table('sex')->insert([
                'sexo' => $array[$i],
            ]);
        }
    }
}
