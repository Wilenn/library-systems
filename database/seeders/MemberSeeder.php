<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Aman dijalankan berulang kali: anggota dicari berdasarkan nama,
     * lalu kode, telepon, dan alamatnya dilengkapi.
     */
    public function run(): void
    {
        $members = [
            ['name' => 'Wisnu', 'member_code' => 'AGT-001', 'phone' => '081234567001', 'address' => 'Karawang'],
            ['name' => 'Bilal', 'member_code' => 'AGT-002', 'phone' => '081234567002', 'address' => 'Karawang'],
            ['name' => 'Yuda', 'member_code' => 'AGT-003', 'phone' => '081234567003', 'address' => 'Bekasi'],
            ['name' => 'Dimas', 'member_code' => 'AGT-004', 'phone' => '081234567004', 'address' => 'Purwakarta'],
            ['name' => 'Zorif', 'member_code' => 'AGT-005', 'phone' => '081234567005', 'address' => 'Karawang'],
        ];

        foreach ($members as $data) {
            Member::updateOrCreate(['name' => $data['name']], $data);
        }
    }
}
