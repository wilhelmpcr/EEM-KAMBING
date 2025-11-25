@extends('layouts.admin.app')

@section('content')
    {{-- startmaincontent --}}
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('user.index') }}">user</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah user</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Tambah user</h1>
                <p class="mb-0">Form untuk menambahkan data user baru.</p>
            </div>
            <div>
                <a href="{{ route('user.index') }}" class="btn btn-primary"><i class="far fa-question-circle me-1"></i>
                    Kembali</a>
            </div>
        </div>
    </div>

    {{-- notif berhasil --}}
    @if (session('success'))
        <div class="alert alert-info">
            {!! session('success') !!}
        </div>
    @endif
    {{-- notif berhasil --}}
    @if (session('delete'))
        <div class="alert alert-info">
            {!! session('delete') !!}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    {{-- Penyesuaian form: action, method, csrf --}}
                    <form action="{{ route('user.store') }}" method="POST"  enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-lg-4 col-sm-6">
                                {{-- First Name --}}
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    {{-- Penyesuaian: name dan old() --}}
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ old('name') }}" required>
                                </div>

                                {{-- email --}}
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    {{-- Penyesuaian: name dan old() --}}
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="{{ old('email') }}" required>
                                </div>

                                <div class="form-group mt-3">
                                    <label class="font-weight-bold text-primary">Foto Profil</label>
                                    <input type="file" name="profile_picture" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                {{-- password --}}
                                <div class="mb-3">
                                    <label for="password" class="form-label">password</label>
                                    {{-- Penyesuaian: name dan old() --}}
                                    <input type="password" id="password" name="password" class="form-control"
                                        value="{{ old('password') }}">
                                </div>


                                {{-- confirmation_password --}}
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">password_confirmation</label>
                                    {{-- Penyesuaian: name dan old() --}}
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" value="{{ old('password_confirmation') }}">
                                </div>

                                {{-- Buttons --}}
                                <div class="">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    {{-- Penyesuaian href tombol "Batal" --}}
                                    <a href="{{ route('user.index') }}" class="btn btn-outline-secondary ms-2">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- endmaincontent --}}
@endsection
