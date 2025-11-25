@extends('layouts.admin.app')

@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
                <li class="breadcrumb-item active">Edit Pelanggan</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Edit Pelanggan</h1>
                <p class="mb-0">Form untuk mengedit data pelanggan</p>
            </div>
            <div>
                <a href="{{ route('pelanggan.show', $dataPelanggan->pelanggan_id) }}" class="btn btn-info">
                    <i class="fas fa-eye me-1"></i> Detail
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
                    <form action="{{ route('pelanggan.update', $dataPelanggan->pelanggan_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Data Pelanggan -->
                            <div class="col-md-6">
                                <h5 class="mb-4">Data Personal</h5>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">First Name</label>
                                            <input type="text" id="first_name" name="first_name"
                                                   class="form-control" value="{{ old('first_name', $dataPelanggan->first_name) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="last_name" class="form-label">Last Name</label>
                                            <input type="text" id="last_name" name="last_name"
                                                   class="form-control" value="{{ old('last_name', $dataPelanggan->last_name) }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="birthday" class="form-label">Birthday</label>
                                    <input type="date" id="birthday" name="birthday"
                                           class="form-control" value="{{ old('birthday', $dataPelanggan->birthday) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="gender" name="gender" class="form-select">
                                        <option value="">-- Pilih --</option>
                                        <option value="Male" {{ old('gender', $dataPelanggan->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ old('gender', $dataPelanggan->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Other" {{ old('gender', $dataPelanggan->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email"
                                           class="form-control" value="{{ old('email', $dataPelanggan->email) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" id="phone" name="phone"
                                           class="form-control" value="{{ old('phone', $dataPelanggan->phone) }}">
                                </div>
                            </div>

                            <!-- File Upload Section -->
                            <div class="col-md-6">
                                <h5 class="mb-4">File Management</h5>

                                <!-- Multiple File Upload -->
                                <div class="mb-4">
                                    <label for="files" class="form-label">Upload Files Baru (Multiple)</label>
                                    <input type="file" id="files" name="files[]"
                                           class="form-control" multiple
                                           accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.txt">
                                    <small class="text-muted">Format: JPG, PNG, PDF, DOC, TXT. Maksimal 2MB per file</small>
                                </div>

                                <!-- Existing Files -->
                                <div class="mb-3">
                                    <label class="form-label">Files Terupload</label>
                                    @if($dataPelanggan->files->count() > 0)
                                        <div class="row">
                                            @foreach($dataPelanggan->files as $file)
                                                <div class="col-12 mb-2">
                                                    <div class="card file-card">
                                                        <div class="card-body py-2">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="d-flex align-items-center">
                                                                    @if(in_array(pathinfo($file->filename, PATHINFO_EXTENSION), ['jpg','jpeg','png','gif']))
                                                                        <img src="{{ asset('storage/' . $file->filename) }}"
                                                                             class="rounded me-3"
                                                                             style="width: 40px; height: 40px; object-fit: cover;">
                                                                    @else
                                                                        <i class="fas fa-file me-3 text-secondary" style="font-size: 1.5rem;"></i>
                                                                    @endif
                                                                    <div>
                                                                        <small class="d-block fw-bold">{{ basename($file->filename) }}</small>
                                                                        <small class="text-muted">{{ \Carbon\Carbon::parse($file->created_at)->format('d/m/Y H:i') }}</small>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <a href="{{ asset('storage/' . $file->filename) }}"
                                                                       target="_blank"
                                                                       class="btn btn-sm btn-info me-1">
                                                                        <i class="fas fa-eye"></i>
                                                                    </a>
                                                                    <a href="{{ asset('storage/' . $file->filename) }}"
                                                                       download
                                                                       class="btn btn-sm btn-success me-1">
                                                                        <i class="fas fa-download"></i>
                                                                    </a>
                                                                    <button type="button"
                                                                            class="btn btn-sm btn-danger"
                                                                            onclick="deleteFile({{ $file->id }})">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-info py-2">
                                            <i class="fas fa-info-circle me-2"></i> Belum ada files terupload.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Data
                            </button>
                            <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete File Form -->
    <form id="deleteFileForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
    function deleteFile(fileId) {
        if(confirm('Yakin ingin menghapus file ini?')) {
            const form = document.getElementById('deleteFileForm');
            form.action = `/customer/file/${fileId}`;
            form.submit();
        }
    }
    </script>

    <style>
    .file-card {
        transition: transform 0.2s;
        border: 1px solid #e0e0e0;
    }
    .file-card:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    </style>
@endsection
