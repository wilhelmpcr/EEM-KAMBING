@extends('layouts.admin.app')

@section('content')
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Edit User</h1>
                <p class="mb-0">Form untuk Edit data user.</p>
            </div>
            <div>
                <a href="{{ route('user.index') }}" class="btn btn-primary">
                    <i class="far fa-question-circle me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-info">
            {!! session('success') !!}
        </div>
    @endif

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    <form action="{{ route('user.update', $dataUser->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-4">
                            <div class="col-lg-4 col-sm-6">
                                <div class="profile-card p-3 text-center">
                                    <label class="form-label fw-bold">Foto Profil Saat Ini</label>
                                    <div class="avatar-wrap my-2">
                                        @if ($dataUser->profile_picture)
                                            {{-- PERBAIKAN PATH: hapus 'profile/' --}}
                                            <img src="{{ asset('storage/' . $dataUser->profile_picture) }}"
                                                 alt="Foto Profil" class="profile-avatar mb-2">
                                        @else
                                            <div class="profile-avatar mb-2 bg-secondary text-white d-flex justify-content-center align-items-center">
                                                {{ strtoupper(substr($dataUser->name, 0, 1)) }}
                                            </div>
                                        @endif

                                        {{-- Checkbox hapus foto --}}
                                        @if($dataUser->profile_picture)
                                        <div class="form-check mt-2">
                                            <input class="form-check-input" type="checkbox" value="1" id="remove_photo" name="remove_photo">
                                            <label class="form-check-label text-danger" for="remove_photo">
                                                Hapus Foto Profil
                                            </label>
                                        </div>
                                        @endif

                                        <div class="small text-muted mt-2">Biarkan kosong jika tidak ingin mengganti foto.</div>
                                    </div>

                                    <div class="mt-3 text-start">
                                        <label for="profile_picture" class="form-label fw-bold">Upload Foto Profil Baru</label>
                                        <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
                                        <small class="text-muted">Format: JPG, PNG, GIF. Maksimal: 2MB</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8 col-sm-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label fw-bold">Nama Lengkap</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                   value="{{ old('name', $dataUser->name) }}" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label fw-bold">Email</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                   value="{{ old('email', $dataUser->email) }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password" class="form-label fw-bold">Password Baru</label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                   placeholder="Kosongkan jika tidak ingin mengubah">
                                            @error('password')
                                                <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password Baru</label>
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                   class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3 d-flex align-items-center">
                                    <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .profile-avatar{
            width:150px;
            height:150px;
            border-radius:50%;
            object-fit:cover;
            border: 6px solid #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        .profile-card{
            background: linear-gradient(180deg, #fff, #fff);
            border-radius: 8px;
        }
        .avatar-wrap{
            display:flex;
            flex-direction:column;
            align-items:center;
        }
        @media(max-width:767px){
            .profile-avatar{
                width:120px;
                height:120px;
            }
        }
    </style>
@endsection
