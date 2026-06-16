<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesin Anjungan E-Tamu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h2>SISTEM ANJUNGAN E-TAMU</h2>
                        <p class="mb-0">Smart Routing & Automatic Department Mapping</p>
                    </div>
                    <div class="card-body p-5">
                        <form action="{{ route('anjungan.submit') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-bold">Nama Lengkap Tamu</label>
                                <input type="text" name="guest_name" class="form-control form-control-lg" placeholder="Masukkan nama Anda..." required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">Keperluan / Alasan Kunjungan</label>
                                <textarea name="purpose" class="form-control form-control-lg" rows="4" placeholder="Contoh: Saya ingin mengurus berkas kenaikan pangkat atau mutasi pegawai..." required></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg py-3 fw-bold">PROSES DAN BERIKAN REKOMENDASI</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>