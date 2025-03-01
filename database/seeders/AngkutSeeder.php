<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AngkutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        require_once 'vendor/autoload.php';

        $faker = Faker::create();
        
        for ($i = 0; $i < 10; $i++) {
            DB::table('angkuts')->insert([
                'id' => Str::uuid(),
                'tgl_masuk' => $faker->date(),
                'kode_trans' => 'TRX' . $faker->randomNumber(4),
                'sopir_nama' => $faker->name(),
                'sopir_nik' => $faker->numerify('#########'),
                'sopir_tlp' => $faker->phoneNumber(),
                'transporter' => $faker->company(),
                'armada' => 'Truck ' . $faker->randomLetter() . $faker->randomDigit(),
                'nopol_mobil' => strtoupper($faker->lexify('B #### ???')),
                'customer' => $faker->company(),
                'tgl_sj' => $faker->date(),
                'no_sj' => 'SJ-' . $faker->randomNumber(3),
                'nama_barang' => $faker->word(),
                'ket_in' => $faker->sentence(),
                'ket_out' => $faker->sentence(),
                'safety_check' => $faker->randomElement(['Passed', 'Failed']),
                'empty_in' => $faker->randomElement(['Yes', 'No']),
                'empty_out' => $faker->randomElement(['Yes', 'No']),
                'user_created' => 'admin',
                'user_updated' => 'admin',
                'waktu_in' => $faker->dateTime(),
                'waktu_out' => $faker->dateTime(),
                'muat_start' => $faker->dateTime(),
                'muat_stop' => $faker->dateTime(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
