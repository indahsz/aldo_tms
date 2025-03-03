<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BongkarSeeder extends Seeder
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
            DB::table('bongkars')->insert([
                'id' => Str::uuid(),
                'tgl_masuk' => $faker->date(),
                'kode_trans' => 'TRZ' . $faker->randomNumber(4),
                'sopir_nama' => $faker->name(),
                'sopir_nik' => $faker->numerify('#########'),
                'sopir_tlp' => $faker->phoneNumber(),
                'nopol_mobil' => strtoupper($faker->lexify('B #### ???')),
                'supplier' => $faker->company(),
                'tgl_sj' => $faker->date(),
                'no_sj' => 'SJ-' . $faker->randomNumber(3),
                'nama_barang' => $faker->word(),
                'ket_in' => $faker->sentence(),
                'ket_out' => $faker->sentence(),
                'empty_in' => $faker->randomElement(['Yes', 'No']),
                'empty_out' => $faker->randomElement(['Yes', 'No']),
                'user_created' => 'admin',
                'user_updated' => 'admin',
                'waktu_in' => $faker->dateTime(),
                'waktu_out' => $faker->dateTime(),
                'bongkar_start' => $faker->dateTime(),
                'bongkar_stop' => $faker->dateTime(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
