<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            ['name_departement' => 'PAPERTUBE', 'slug_departement' => 'PT'],
            ['name_departement' => 'HONEYCOMB & PAPERCORE', 'slug_departement' => 'HPC'],
            ['name_departement' => '', 'slug_departement' => '']

        ];

        foreach ($data as $item){
            DB::table('departements')->insert([
                'id' => Str::uuid(),
                'name_departement' => $item['name_departement'],
                'slug_departement' => $item['slug_departement'],
            ]);

        }
    }
}
