<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Smart Routing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0 text-center">
                    <div class="card-header bg-success text-white py-4">
                        <h4>Sistem Berhasil Mengklasifikasi Tujuan Anda!</h4>
                    </div>
                    <div class="card-body p-5">
                        <p class="text-muted">Halo, <strong>{{ $guest->guest_name }}</strong>. Berdasarkan keperluan Anda:</p>
                        <blockquote class="blockquote bg-light p-3 rounded text-start">
                            <p class="mb-0 text-secondary">"{{ $guest->purpose }}"</p>
                        </blockquote>
                        <hr>
                        <h5 class="mt-4">Rekomendasi Tujuan Bidang:</h5>
                        <div class="alert alert-info py-4 my-3">
                            <h2 class="alert-heading fw-bold text-primary">{{ $department->code }}</h2>
                            <p class="lead mb-0">({{ $department->name }})</p>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6 text-start">
                                <strong>Akurasi Rekomendasi:</strong> 
                                <span class="badge bg-warning text-dark fs-6">{{ $accuracy }}%</span>
                            </div>
                            <div class="col-6 text-end">
                                <strong>Kata Kunci Cocok:</strong> 
                                <span class="text-success fw-bold">{{ implode(', ', $matched_words) ?: '-' }}</span>
                            </div>
                        </div>
                        <hr class="my-4">
                        <a href="{{ route('anjungan.index') }}" class="btn btn-secondary btn-lg px-5">Kembali ke Utama</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>