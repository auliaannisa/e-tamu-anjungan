<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Diri - E-Tamu BKPSDM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #7fa0c3; /* Warna latar belakang biru sesuai gambar Anda */
        }
        .card-custom {
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .form-control-custom {
            background-color: #f0f0f0;
            border: none;
            border-radius: 8px;
            padding: 12px 15px;
        }
        .form-control-custom:focus {
            background-color: #e8e8e8;
            box-shadow: none;
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
                        <h3 class="fw-bold text-dark mb-1" style="letter-spacing: 0.5px;">INPUT DATA DIRI</h3>
                        <small class="text-muted">Silahkan lengkapi data kunjungan Anda</small>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger py-2 small">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('anjungan.submit') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nik" class="form-label fw-semibold text-dark mb-1">NIK</label>
                            <input type="text" class="form-control form-control-custom" id="nik" name="nik" placeholder="Masukkan NIK" required value="{{ old('nik') }}">
                        </div>

                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label fw-semibold text-dark mb-1">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-custom" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" required value="{{ old('nama_lengkap') }}">
                        </div>

                        <div class="mb-3">
                            <label for="instansi" class="form-label fw-semibold text-dark mb-1">Instansi / Perusahaan</label>
                            <input type="text" class="form-control form-control-custom" id="instansi" name="instansi" placeholder="Masukkan instansi / perusahaan" required value="{{ old('instansi') }}">
                        </div>

                        <div class="mb-3">
                            <label for="nomor_hp" class="form-label fw-semibold text-dark mb-1">Nomor HP</label>
                            <input type="text" class="form-control form-control-custom" id="nomor_hp" name="nomor_hp" placeholder="Masukkan nomor HP" required value="{{ old('nomor_hp') }}">
                        </div>

                        <div class="mb-4">
                            <label for="keperluan" class="form-label fw-semibold text-dark mb-1">Keperluan</label>
                            <textarea class="form-control form-control-custom" id="keperluan" name="keperluan" rows="3" placeholder="Isi keperluan kunjungan" required>{{ old('keperluan') }}</textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-custom text-uppercase">Lanjutkan</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

</body>
</html>