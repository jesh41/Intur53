<?php

use Illuminate\Database\Seeder;

class catreason extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array=array("Turismo","Congresos","Negocios","Otros");

    	for($i=0;$i<4;$i++){
            DB::table('reason')->insert([
                'motivo' => $array[$i],
            ]);
        }
    }
}
