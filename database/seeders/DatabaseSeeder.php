<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        Admin::create([
            'first_name' => 'admin',
            'last_name' => '',
            'gender' => 'Laki-Laki',
            'tempat_lahir' => 'palembang',
            'kota' => 'palembang ',
            'kode_pos' => '1234 ',
            'kebangsaan' => 'indonesia ',
            'tanggal_lahir' => '2023-02-24 ',
            'alamat' => 'palembang ',
            'no_telepon' => '3141231 ',
            'email' => 'admin@gmail.com ',
        ]);
        Admin::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'gender' => 'Laki-Laki',
            'tempat_lahir' => 'palembang',
            'kota' => 'palembang ',
            'kode_pos' => '1234 ',
            'kebangsaan' => 'indonesia ',
            'tanggal_lahir' => '2023-02-24 ',
            'alamat' => 'palembang ',
            'no_telepon' => '3141231 ',
            'email' => 'admin@gmail.com ',
        ]);

        Driver::create([
            'first_name'=>'Driver',
            'last_name'=>' ',
            'gender'=>'Laki-Laki',
            'tempat_lahir'=>'Linggau',
            'kota'=>'Palembang',
            'kode_pos'=>'15123',
            'kebangsaan'=>'Indonesia',
            'tanggal_lahir'=>'2002-02-18',
            'alamat'=>'palemabng',
            'no_telepon'=>'08321413',
            'email'=>'Galih@gmail.com',
        ]);

        User::create([
            'username' => 'admin',
            'password' => bcrypt('123'),
            'email' => 'admin@gmail.com',
            'admin_id' => 1,
            'level' => 'admin ',
        ]);
        User::create([
            'username' => 'superadmin',
            'password' => bcrypt('123'),
            'email' => 'superAdmin@gmail.com',
            'admin_id' => 2,
            'level' => 'super_admin ',
        ]);
        User::create([
            'username' => 'driver',
            'password' => bcrypt('123'),
            'email' => 'Driver@gmail.com',
            'driver_id' => 1,
            'level' => 'driver ',
        ]);
        
        $this->call(PertanyaanSeeder::class);
    }
}
