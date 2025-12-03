<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\DosenProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get role IDs
        $adminRole = Role::where('name', 'admin')->first();
        $dosenRole = Role::where('name', 'dosen')->first();

        // Create Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@niyasayang.com',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
        ]);

        // Create Dosen Users with Profiles
        $dosens = [
            [
                'name' => 'Dr. Ahmad Fauzi, M.Kom',
                'email' => 'ahmad.fauzi@niyasayang.com',
                'nidn' => '0101018901',
            ],
            [
                'name' => 'Prof. Siti Nurhaliza, Ph.D',
                'email' => 'siti.nurhaliza@niyasayang.com',
                'nidn' => '0102028902',
            ],
            [
                'name' => 'Dr. Budi Santoso, M.T',
                'email' => 'budi.santoso@niyasayang.com',
                'nidn' => '0103038903',
            ],
            [
                'name' => 'Dr. Rina Wijaya, M.Kom',
                'email' => 'rina.wijaya@niyasayang.com',
                'nidn' => '0104048904',
            ],
            [
                'name' => 'Dr. Eko Prasetyo, M.Sc',
                'email' => 'eko.prasetyo@niyasayang.com',
                'nidn' => '0105058905',
            ],
            [
                'name' => 'Dr. Dewi Lestari, M.Kom',
                'email' => 'dewi.lestari@niyasayang.com',
                'nidn' => '0106068906',
            ],
            [
                'name' => 'Dr. Hendra Gunawan, M.T',
                'email' => 'hendra.gunawan@niyasayang.com',
                'nidn' => '0107078907',
            ],
            [
                'name' => 'Dr. Maya Sari, M.Kom',
                'email' => 'maya.sari@niyasayang.com',
                'nidn' => '0108088908',
            ],
            [
                'name' => 'Dr. Rizki Firmansyah, M.Sc',
                'email' => 'rizki.firmansyah@niyasayang.com',
                'nidn' => '0109098909',
            ],
            [
                'name' => 'Dr. Fitri Handayani, M.Kom',
                'email' => 'fitri.handayani@niyasayang.com',
                'nidn' => '0110108910',
            ],
        ];

        foreach ($dosens as $dosen) {
            $user = User::create([
                'name' => $dosen['name'],
                'email' => $dosen['email'],
                'password' => Hash::make('password'),
                'role_id' => $dosenRole->id,
            ]);

            DosenProfile::create([
                'user_id' => $user->id,
                'nidn' => $dosen['nidn'],
            ]);
        }
    }
}
