<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Keyword;
use App\Models\GuestRequest;

class GuestRoutingController extends Controller
{
    // 1. Tampilan Halaman Utama Mesin Anjungan
    public function index()
    {
        return view('anjungan.index');
    }

    // 2. Proses Inti Algoritma Keyword Mapping & Smart Routing
    public function processRouting(Request $request)
    {
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'purpose' => 'required|string',
        ]);

        $name = $request->guest_name;
        $purpose = $request->purpose;
        
        // Pembersihan input kalimat (diubah jadi huruf kecil semua agar case-insensitive)
        $clean_input = strtolower($purpose);

        // Ambil semua kata kunci yang ada di database
        $allKeywords = Keyword::all();
        $scores = [];
        $matched_words = [];

        // Inisialisasi skor kecocokan awal untuk setiap bidang = 0
        $departments = Department::all();
        foreach ($departments as $dept) {
            $scores[$dept->id] = 0;
            $matched_words[$dept->id] = [];
        }

        // Jalankan Algoritma Keyword Mapping
        foreach ($allKeywords as $kw) {
            // Jika kata kunci terdeteksi di dalam kalimat input tamu
            if (str_contains($clean_input, $kw->keyword_word)) {
                $scores[$kw->department_id] += 1; // Naikkan poin bidang terkait
                $matched_words[$kw->department_id][] = $kw->keyword_word; // Catat kata yang cocok
            }
        }

        // Urutkan skor dari yang paling tinggi ke rendah
        arsort($scores);
        $best_dept_id = key($scores);
        $highest_score = current($scores);

        // Aturan khusus: Jika tidak ada satupun kata kunci yang cocok (skor = 0)
        if ($highest_score == 0) {
            // Alihkan otomatis sebagai tamu umum ke Sekretariat
            $default_dept = Department::where('code', 'Sekretariat')->first();
            $best_dept_id = $default_dept ? $default_dept->id : null;
            $accuracy = 0;
        } else {
            // Perhitungan Akurasi: (Jumlah kata yang cocok / Total kata kunci bidang tersebut) * 100
            $total_dept_keywords = Keyword::where('department_id', $best_dept_id)->count();
            $accuracy = ($highest_score / $total_dept_keywords) * 100;
            $accuracy = $accuracy > 100 ? 100 : round($accuracy, 2);
        }

        // Simpan riwayat kunjungan tamu ke database tabel guest_requests
        $guestLog = GuestRequest::create([
            'guest_name' => $name,
            'purpose' => $purpose,
            'matched_department_id' => $best_dept_id,
            'accuracy_score' => $accuracy
        ]);

        // Ambil data detail bidang pemenang untuk ditampilkan di layar
        $recommended_department = Department::find($best_dept_id);

        return view('anjungan.result', [
            'guest' => $guestLog,
            'department' => $recommended_department,
            'accuracy' => $accuracy,
            'matched_words' => $matched_words[$best_dept_id] ?? []
        ]);
    }
}