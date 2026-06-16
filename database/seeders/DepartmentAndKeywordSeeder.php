<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Keyword;

class DepartmentAndKeywordSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Pengadaan, Pemberhentian, dan Informasi Kepegawaian',
                'code' => 'PPIK',
                'keywords' => ['pensiun', 'cpns', 'p3k', 'resign', 'berhenti', 'data pegawai', 'kartu pegawai', 'sk', 'informasi']
            ],
            [
                'name' => 'Mutasi, Promosi, dan Kepangkatan',
                'code' => 'MUTPRO',
                'keywords' => ['pindah', 'mutasi', 'naik pangkat', 'promosi', 'jabatan', 'golongan', 'rotasi']
            ],
            [
                'name' => 'UPT Pengembangan Kompetensi',
                'code' => 'UPT Penkom',
                'keywords' => ['pelatihan', 'diklat', 'kursus', 'sertifikasi', 'kompetensi', 'workshop', 'bimbingan teknis', 'bimtek']
            ],
            [
                'name' => 'Bidang Pengadaan, Pemberhentian, dan Evaluasi Kinerja',
                'code' => 'PPEK',
                'keywords' => ['skp', 'kinerja', 'evaluasi', 'nilai', 'raport pegawai', 'disiplin', 'sanksi', 'penghargaan']
            ],
            [
                'name' => 'Sekretariat',
                'code' => 'Sekretariat',
                'keywords' => ['surat', 'proposal', 'undangan', 'legalisir', 'keuangan', 'sarpras', 'peminjaman', 'magang', 'pkl']
            ],
        ];

        foreach ($data as $item) {
            $dept = Department::create([
                'name' => $item['name'],
                'code' => $item['code']
            ]);

            foreach ($item['keywords'] as $word) {
                Keyword::create([
                    'department_id' => $dept->id,
                    'keyword_word' => strtolower($word)
                ]);
            }
        }
    }
}