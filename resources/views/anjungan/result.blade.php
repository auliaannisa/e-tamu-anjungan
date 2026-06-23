<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Analisis Rute Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #7fa0c3; /* Menyamakan warna latar belakang dengan halaman input */
        }
        .card-custom {
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .btn-custom {
            background-color: #245a8e;
            color: white;
            font-weight: bold;
            padding: 12px;
            border-radius: 8px;
            border: none;
        }
        .btn-custom:hover {
            background-color: #1a436d;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-10 col-md-6">
                
                <div class="card card-custom bg-white p-4 p-md-5">
                    
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-dark mb-1">HASIL REKOMENDASI</h3>
                        <small class="text-muted">Analisis rute tujuan berdasarkan keperluan Anda</small>
                    </div>

                    <div class="bg-light p-3 rounded-3 mb-4 small">
                        <table class="table table-sm table-borderless mb-0 text-dark">
                            <tr>
                                <td style="width: 140px;" class="fw-semibold">NIK</td>
                                <td>: {{ $nik }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Nama Lengkap</td>
                                <td>: {{ $nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Instansi</td>
                                <td>: {{ $instansi }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Nomor HP</td>
                                <td>: {{ $nomor_hp }}</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold">Keperluan</td>
                                <td>: <span class="fst-italic text-secondary">"{{ $input_keperluan }}"</span></td>
                            </tr>
                        </table>
                    </div>

                    <h6 class="fw-bold text-dark mb-2">Silakan Menuju Ke Ruangan:</h6>
                    
                    <div class="alert alert-success border-0 p-4 mb-4 d-flex justify-content-between align-items-center" style="background-color: #e8f5e9; border-radius: 12px;">
                        <div>
                            <h3 class="alert-heading fw-bold text-success mb-1" style="line-height: 1.2;">
                                {{ $rekomendasi['nama_bidang'] }}
                            </h3>
                            <span class="badge bg-success px-2 py-1.5 mt-1">KODE: {{ $rekomendasi['kode_bidang'] }}</span>
                        </div>
                        
                        <div class="text-end ps-3" style="min-width: 100px;">
                            <small class="d-block text-muted fw-semibold small mb-0" style="font-size: 0.75rem;">Akurasi</small>
                            <span class="fs-1 fw-bold text-success" style="line-height: 1;">
                                {{ $rekomendasi['persentase_akurasi'] }}%
                            </span>
                        </div>
                    </div>

                    <div class="d-grid">
                        <a href="{{ route('anjungan.index') }}" class="btn btn-custom text-uppercase">Selesai / Kembali</a>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</body>
</html>