<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnityTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unity_types')->insert([
            [
                'id'         => 1,
                'name'       => 'Unidade',
                'created_at' => Carbon::create(),
                'updated_at' => Carbon::create()
            ],
            [
                'id'         => 2,
                'name'       => 'Kg',
                'created_at' => Carbon::create(),
                'updated_at' => Carbon::create()
            ],
            [
                'id'         => 3,
                'name'       => 'g',
                'created_at' => Carbon::create(),
                'updated_at' => Carbon::create()
            ]
        ]);
    }
}
