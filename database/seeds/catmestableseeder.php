<?php

use Illuminate\Database\Seeder;

class catmestableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    	for($i=0;$i<12;$i++){
            DB::table('months')->insert([
                'mes' => $array[$i],
            ]);
        }
    }
}
