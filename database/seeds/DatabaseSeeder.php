<?php

use App\Domain\Models\UserStatus;
use App\Domain\Models\UserType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            [
                'id'         => 1,
                'name'       => 'Administrador',
                'created_at' => Carbon::create(),
                'updated_at' => Carbon::create()
            ],
            [
                'id'         => 2,
                'name'       => 'Client',
                'created_at' => Carbon::create(),
                'updated_at' => Carbon::create()
            ]
        ]);

        DB::table('user_status')->insert([
            [
                'id'         => 1,
                'name'       => 'Ativo',
                'created_at' => Carbon::create(),
                'updated_at' => Carbon::create()
            ],
            [
                'id'         => 2,
                'name'       => 'Inativo',
                'created_at' => Carbon::create(),
                'updated_at' => Carbon::create()
            ]
        ]);

        DB::table('users')->insert([
            'name'           => 'Admin',
            'email'          => 'admin@admin.com',
            'password'       => bcrypt('admin'),
            'user_type_id'   => UserType::ADMINISTRATOR,
            'user_status_id' => UserStatus::ACTIVE,
            'created_at'     => Carbon::create(),
            'updated_at'     => Carbon::create()
        ]);

        DB::table('product_status')->insert([
            [
                'id'         => 1,
                'name'       => 'Ativo',
                'created_at' => Carbon::create(),
                'updated_at' => Carbon::create()
            ],
            [
                'id'         => 2,
                'name'       => 'Inativo',
                'created_at' => Carbon::create(),
                'updated_at' => Carbon::create()
            ]
        ]);

        DB::table('sale_status')->insert([
            [
                'id'         => 1,
                'name'       => 'Ativo',
                'created_at' => Carbon::create(),
                'updated_at' => Carbon::create()
            ],
            [
                'id'         => 2,
                'name'       => 'Inativo',
                'created_at' => Carbon::create(),
                'updated_at' => Carbon::create()
            ]
        ]);

        DB::table('announcement_status')->insert([
            [
                'id'         => 1,
                'name'       => 'Ativo',
                'created_at' => Carbon::create(),
                'updated_at' => Carbon::create()
            ],
            [
                'id'         => 2,
                'name'       => 'Inativo',
                'created_at' => Carbon::create(),
                'updated_at' => Carbon::create()
            ]
        ]);
    }
}
