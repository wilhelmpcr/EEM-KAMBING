@extends('layouts.admin.app')

@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                <li class="breadcrumb-item active">Detail Pelanggan</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Detail Pelanggan</h1>
                <p class="mb-0">Informasi lengkap data pelanggan</p>
            </div>
            <div>
                <a href="{{ route('pelanggan.edit', $dataPelanggan->pelanggan_id) }}" class="btn btn-primary">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row">
                        <!-- Data Pelanggan -->
                        <div class="col-md-6">
                            <h5 class="mb-4">Data Personal</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th width="40%">Nama Lengkap</th>
                                    <td>{{ $dataPelanggan->first_name }} {{ $dataPelanggan->last_name }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>{{ $dataPelanggan->birthday ? \Carbon\Carbon::parse($dataPelanggan->birthday)->format('d/m/Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>{{ $dataPelanggan->gender }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $dataPelanggan->email }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>{{ $dataPelanggan->phone }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Files Upload -->
                        <div class="col-md-6">
                            <h5 class="mb-4">Files Terupload</h5>
                            @if($dataPelanggan->files->count() > 0)
                                <div class="row">
                                    @foreach($dataPelanggan->files as $file)
                                        <div class="col-md-6 mb-3">
                                            <div class="card file-card h-100">
                                                <div class="card-body text-center">
                                                    @if(in_array(pathinfo($file->filename, PATHINFO_EXTENSION), ['jpg','jpeg','png','gif']))
                                                        <img src="{{ asset('storage/' . $file->filename) }}"
                                                             class="img-fluid mb-2"
                                                             style="max-height: 120px; object-fit: cover;"
                                                             alt="File Image">
                                                    @else
                                                        <div class="file-icon mb-2">
                                                            <i class="fas fa-file fa-3x text-secondary"></i>
                                                        </div>
                                                    @endif
                                                    <small class="d-block text-truncate" title="{{ basename($file->filename) }}">
                                                        {{ basename($file->filename) }}
                                                    </small>
                                                    <div class="mt-2">
                                                        <a href="{{ asset('storage/' . $file->filename) }}"
                                                           target="_blank"
                                                           class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye me-1"></i> View
                                                        </a>
                                                        <a href="{{ asset('storage/' . $file->filename) }}"
                                                           download
                                                           class="btn btn-sm btn-success">
                                                            <i class="fas fa-download me-1"></i> Download
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i> Belum ada files terupload.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .file-card {
            transition: transform 0.2s;
            border: 1px solid #e0e0e0;
        }
        .file-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .table th {
            background-color: #f8f9fa;
        }
    </style>
@endsection
