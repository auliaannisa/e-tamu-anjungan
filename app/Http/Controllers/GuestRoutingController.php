<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Keyword;

class GuestRoutingController extends Controller
{
    /**
     * 1. Menampilkan Form Input Tamu (GET /)
     */
    public function index()
    {
        return view('anjungan.index');
    }

    /**
     * 2. Memproses Data Diri & Keperluan Tamu (POST /process-routing)
     */
    public function processRouting(Request $request)
    {
        // Validasi input sesuai komponen pada gambar UI Anda
        $request->validate([
            'nik'          => 'required|numeric|digits_between:16,17',
            'nama_lengkap' => 'required|string|max:150',
            'instansi'     => 'required|string|max:150',
            'nomor_hp'     => 'required|string|max:15',
            'keperluan'    => 'required|string'
        ]);

        // Tampung data input ke dalam variabel
        $nik         = $request->input('nik');
        $namaLengkap = $request->input('nama_lengkap');
        $instansi    = $request->input('instansi');
        $nomorHp     = $request->input('nomor_hp');
        $keperluan   = $request->input('keperluan');

        // --- TAHAP 1: PREPROCESSING TEKS & HITUNG TOTAL KATA ---
        $teksBersih = strtolower($keperluan);
        $teksBersih = preg_replace('/[^a-zA-Z0-9\s]/', '', $teksBersih);
        
        $arrayKata = array_filter(explode(' ', $teksBersih));
        $totalKataInput = count($arrayKata) > 0 ? count($arrayKata) : 1;

        // --- TAHAP 2: AMBIL DATA MASTER ---
        $masterKeywords = Keyword::with('department')->get();
        $semuaBidang = Department::all();

        // --- TAHAP 3: INISIALISASI SKOR ---
        $skorBidang = [];
        foreach ($semuaBidang as $bidang) {
            $skorBidang[$bidang->code] = [
                'id_bidang' => $bidang->id,
                'nama_bidang' => $bidang->name,
                'skor' => 0
            ];
        }

        // --- TAHAP 4: ALGORITMA KEYWORD MAPPING (SCORING) ---
        $jumlahKataKunciCocok = 0;
        foreach ($masterKeywords as $item) {
            if ($item->department && str_contains($teksBersih, $item->keyword_word)) {
                $skorBidang[$item->department->code]['skor'] += 1;
                $jumlahKataKunciCocok += count(explode(' ', $item->keyword_word));
            }
        }

        // --- TAHAP 5: PENENTUAN BIDANG TERBAIK ---
        $bidangRekomendasi = null;
        $skorMaksimal = 0;

        foreach ($skorBidang as $kode => $data) {
            if ($data['skor'] > $skorMaksimal) {
                $skorMaksimal = $data['skor'];
                $bidangRekomendasi = [
                    'kode_bidang' => $kode,
                    'nama_bidang' => $data['nama_bidang'],
                    'skor_mentah' => $skorMaksimal
                ];
            }
        }

        // --- TAHAP 6: HANDLING JIKA TIDAK COCOK & PERSENTASE AKURASI ---
        if ($skorMaksimal === 0) {
            $bidangRekomendasi = [
                'kode_bidang' => 'SEKRETARIAT',
                'nama_bidang' => 'Sekretariat (Pusat Informasi Umum)',
                'persentase_akurasi' => 0
            ];
        } else {
            $persentase = ($jumlahKataKunciCocok / $totalKataInput) * 100;
            $bidangRekomendasi['persentase_akurasi'] = min(round($persentase), 100);
        }

        // --- TAHAP 7: OPER DATA LENGKAP KE HALAMAN HASIL ---
        return view('anjungan.result', [
            'nik'             => $nik,
            'nama_lengkap'    => $namaLengkap,
            'instansi'        => $instansi,
            'nomor_hp'        => $nomorHp,
            'input_keperluan' => $keperluan,
            'rekomendasi'     => $bidangRekomendasi,
            'log_skor'        => $skorBidang
        ]);
    }
}