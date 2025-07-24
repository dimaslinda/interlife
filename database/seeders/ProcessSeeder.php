<?php

namespace Database\Seeders;

use App\Models\Process;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $processes = [
            [
                'step_number' => 1,
                'title' => 'Konsultasi & Survey Lokasi Gratis',
                'description' => 'Kami melakukan konsultasi awal dan survey lokasi untuk memahami kebutuhan dan membuat estimasi biaya awal',
                'additional_info' => null,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'step_number' => 2,
                'title' => 'Pembuatan Desain 3D',
                'description' => 'Setelah setujui spesifikasi, Kami mengajukan biaya desain mulai dari Rp500.000 sebagai komitmen',
                'additional_info' => 'Biaya ini akan dipotong dari total proyek bila terjadi ke produksi sehingga menjadi gratis.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'step_number' => 3,
                'title' => 'Produksi di Workshop',
                'description' => 'Setelah desain dan harga disetujui, Kami memproses DP 50% untuk memulai proses produksi di workshop',
                'additional_info' => null,
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'step_number' => 4,
                'title' => 'Instalasi di Tempat Anda',
                'description' => 'Setelah produksi selesai, tim kami melakukan pemasangan. Pelunasan dilakukan setelah instalasi tuntas',
                'additional_info' => null,
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'step_number' => 5,
                'title' => 'Garansi & After Sales',
                'description' => 'Kami memberi garansi 1 tahun sejak serah terima untuk memastikan kepuasan Anda',
                'additional_info' => null,
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($processes as $process) {
            Process::create($process);
        }
    }
}
