<?php

namespace Database\Seeders;

use App\Models\Matkul;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatkulSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $matkuls = [
            // Semester 1
            [
                'nama_matkul' => 'Pemrograman Web',
                'sks' => 3,
                'semester' => 1,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Basis Data',
                'sks' => 3,
                'semester' => 1,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Algoritma dan Struktur Data',
                'sks' => 4,
                'semester' => 1,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Matematika Diskrit',
                'sks' => 3,
                'semester' => 1,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Bahasa Inggris',
                'sks' => 2,
                'semester' => 1,
                'prodi' => 'Teknik Informatika',
            ],

            // Semester 2
            [
                'nama_matkul' => 'Pemrograman Berorientasi Objek',
                'sks' => 3,
                'semester' => 2,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Sistem Operasi',
                'sks' => 3,
                'semester' => 2,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Jaringan Komputer',
                'sks' => 3,
                'semester' => 2,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Kalkulus',
                'sks' => 3,
                'semester' => 2,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Statistika dan Probabilitas',
                'sks' => 3,
                'semester' => 2,
                'prodi' => 'Teknik Informatika',
            ],

            // Semester 3
            [
                'nama_matkul' => 'Rekayasa Perangkat Lunak',
                'sks' => 4,
                'semester' => 3,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Machine Learning',
                'sks' => 3,
                'semester' => 3,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Keamanan Informasi',
                'sks' => 3,
                'semester' => 3,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Interaksi Manusia dan Komputer',
                'sks' => 2,
                'semester' => 3,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Sistem Informasi',
                'sks' => 3,
                'semester' => 3,
                'prodi' => 'Teknik Informatika',
            ],

            // Semester 4
            [
                'nama_matkul' => 'Cloud Computing',
                'sks' => 3,
                'semester' => 4,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Artificial Intelligence',
                'sks' => 3,
                'semester' => 4,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Data Mining',
                'sks' => 3,
                'semester' => 4,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Mobile Programming',
                'sks' => 3,
                'semester' => 4,
                'prodi' => 'Teknik Informatika',
            ],
            [
                'nama_matkul' => 'Etika Profesi',
                'sks' => 2,
                'semester' => 4,
                'prodi' => 'Teknik Informatika',
            ],
        ];

        foreach ($matkuls as $matkul) {
            Matkul::create($matkul);
        }
    }
}
