<?php

use Illuminate\Database\Seeder;

class category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ["Una Estrella", "Dos Estrellas", "Tres Estrellas", "cuatro Estrellas", "Cinco Estrellas"];

        for ($i = 0; $i < 5; $i++) {
            DB::table('category')->insert([
                'categoria' => $array[$i],
            ]);
        }
    }
}
