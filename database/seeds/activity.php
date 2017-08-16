<?php

use Illuminate\Database\Seeder;

class activity extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ["Albergue", "Aparto-Hotel", "Casa de Huésped", "Hostal Familiar", "Hotel", "Pension"];

        for ($i = 0; $i < 6; $i++) {
            DB::table('activity')->insert([
                'actividad' => $array[$i],
            ]);
        }
    }
}
