<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PertanyaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pertanyaans')->insert([
            [
                'kategori' => 'document',
                'pertanyaan' => 'STNK (dalam kondisi masih berlaku)',
            ],
            [
                'kategori' => 'document',
                'pertanyaan' => 'Buku KIR (dalam masih berlaku)',
            ],
            [
                'kategori' => 'document',
                'pertanyaan' => 'Izin Usaha',
            ],
            [
                'kategori' => 'document',
                'pertanyaan' => 'Izin TIO (Stiker Tambang)',
            ],
            [
                'kategori' => 'document',
                'pertanyaan' => 'Izin Masuk Kota / Kabupaten',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Kebersihan Luar dan Dalam Kabin',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Kondisi Air Conditioner (AC)',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Fire Extinguisher (Pemadam Api)',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'First Aid Kit (Perlengkapan P3K Khusus)',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Safety Belt All (Sabuk Pengaman)',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Miror (Spion)',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Horn (Klakson)',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Radio Komunikasi',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Bendera (Buggy Flag)',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Light (Lampu - Lampu, Rotary Lamp)',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Back Alarm (Alarm Belakang)',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'All Door & Lock Condition',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Ban Depan Kanan',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Ban Depan Kiri',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Ban Belakang Kanan',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Ban Belakang Kiri',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Ban Cadangan ',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Wiper Condition  (Kondisi Wiper dan Airnya)',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Gauge Working (Jarum Penunjuk / Indikator)',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Hand Brake (Rem Tangan)',
            ],
            [
                'kategori' => 'safety',
                'pertanyaan' => 'Safety Triangle (Segitiga Pengaman)',
            ],
            [
                'kategori' => 'engine',
                'pertanyaan' => 'Steering Condition (Kondisi Kemudi))',
            ],
            [
                'kategori' => 'engine',
                'pertanyaan' => 'Brake Fluid (Minyak Rem)',
            ],
            [
                'kategori' => 'engine',
                'pertanyaan' => 'Brake Function (Fungsi Rem depan)',
            ],
            [
                'kategori' => 'engine',
                'pertanyaan' => 'Brake Function (Fungsi Rem belakang)',
            ],
            [
                'kategori' => 'engine',
                'pertanyaan' => 'Water Level (Air Radiator + Tutupnya)',
            ],
            [
                'kategori' => 'engine',
                'pertanyaan' => 'Engine Oil Level (Oli Mesin)',
            ],
            [
                'kategori' => 'engine',
                'pertanyaan' => 'Clutch Fluid (Minyak Kopling)',
            ],
            [
                'kategori' => 'engine',
                'pertanyaan' => 'Battery Condition (Kondisi Battery)',
            ],
            [
                'kategori' => 'engine',
                'pertanyaan' => '4 x 4 FWD Functioning (Fungsi Double Garden)',
            ],
            [
                'kategori' => 'tools',
                'pertanyaan' => 'Jack (Dongkrak)',
            ],
            [
                'kategori' => 'tools',
                'pertanyaan' => 'Wheel Spanner (Kunci Roda)',
            ],
            [
                'kategori' => 'tools',
                'pertanyaan' => 'Jack Handle (Handle Jack',
            ],
            
        ]);
    }
}
