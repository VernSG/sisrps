<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\MahasiswaProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get mahasiswa role ID
        $mahasiswaRole = Role::where('name', 'mahasiswa')->first();

        // Create Mahasiswa Users with Profiles
        $mahasiswas = [
            [
                'name' => 'Andi Wijaya',
                'email' => 'andi.wijaya@student.niyasayang.com',
                'npm' => '2021001001',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2021',
            ],
            [
                'name' => 'Siti Rahmawati',
                'email' => 'siti.rahmawati@student.niyasayang.com',
                'npm' => '2021001002',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2021',
            ],
            [
                'name' => 'Budi Kurniawan',
                'email' => 'budi.kurniawan@student.niyasayang.com',
                'npm' => '2021001003',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2021',
            ],
            [
                'name' => 'Dewi Sartika',
                'email' => 'dewi.sartika@student.niyasayang.com',
                'npm' => '2021001004',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2021',
            ],
            [
                'name' => 'Reza Pratama',
                'email' => 'reza.pratama@student.niyasayang.com',
                'npm' => '2021001005',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2021',
            ],
            [
                'name' => 'Maya Anggraini',
                'email' => 'maya.anggraini@student.niyasayang.com',
                'npm' => '2022001001',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2022',
            ],
            [
                'name' => 'Faisal Rahman',
                'email' => 'faisal.rahman@student.niyasayang.com',
                'npm' => '2022001002',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2022',
            ],
            [
                'name' => 'Nurul Hidayah',
                'email' => 'nurul.hidayah@student.niyasayang.com',
                'npm' => '2022001003',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2022',
            ],
            [
                'name' => 'Arif Budiman',
                'email' => 'arif.budiman@student.niyasayang.com',
                'npm' => '2023001001',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2023',
            ],
            [
                'name' => 'Lestari Wulandari',
                'email' => 'lestari.wulandari@student.niyasayang.com',
                'npm' => '2023001002',
                'prodi' => 'Teknik Informatika',
                'angkatan' => '2023',
            ],
        ];

        foreach ($mahasiswas as $mahasiswa) {
            $user = User::create([
                'name' => $mahasiswa['name'],
                'email' => $mahasiswa['email'],
                'password' => Hash::make('password'),
                'role_id' => $mahasiswaRole->id,
            ]);

            MahasiswaProfile::create([
                'user_id' => $user->id,
                'npm' => $mahasiswa['npm'],
                'prodi' => $mahasiswa['prodi'],
                'angkatan' => $mahasiswa['angkatan'],
            ]);
        }
    }
}
