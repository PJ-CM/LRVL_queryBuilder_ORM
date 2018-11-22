<?php

use Illuminate\Database\Seeder;

class DatosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<10;$i++) {
            //Generate a timestamp using mt_rand.
            $timestamp = mt_rand(1, time());
            //Format that timestamp into a readable date string.
            //$randomDate = date("d M Y", $timestamp);
            $randomDate = date("Y-m-d H:i:s", $timestamp);
            //Print it out.
            //echo $randomDate;

            DB::table('datos')->insert([
                'nombre' => str_random(10),
                'contrasenia' => bcrypt('mi_pass'),
                'edad' => random_int(16, 100),
                'saldo' => random_int(0, 100) / 10,
                'comentarios' => 'Comentario ['.$i.']:'.str_random(74),
                'register_at' => $randomDate,
                'activo' => random_int(0, 1),
            ]);
        }
    }
}
