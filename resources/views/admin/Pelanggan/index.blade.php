@extends('layouts.admin.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3">Data Pelanggan</h1>
            <p class="mb-0">List data seluruh pelanggan</p>
        </div>
        <a href="{{ route('pelanggan.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Tambah Pelanggan
        </a>
    </div>

    <!-- Alert -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('pelanggan.index') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-select" onchange="this.form.submit()">
                            <option value="">All Gender</option>
                            <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ request('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Search</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                   value="{{ request('search') }}" placeholder="Search by name...">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                            @if (request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="btn btn-secondary">
                                    Clear
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="table-dark">
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Birthday</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataPelanggan as $item)
                        <tr>
                            <td><strong>{{ $item->first_name }}</strong></td>
                            <td>{{ $item->last_name }}</td>
                            <td>
                                @if($item->birthday)
                                    {{ \Carbon\Carbon::parse($item->birthday)->format('d/m/Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($item->gender == 'Male')
                                    <span class="badge bg-primary">Male</span>
                                @elseif($item->gender == 'Female')
                                    <span class="badge bg-success">Female</span>
                                @else
                                    <span class="badge bg-secondary">Other</span>
                                @endif
                            </td>
                            <td><small>{{ $item->email }}</small></td>
                            <td><small>{{ $item->phone }}</small></td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('pelanggan.show', $item->pelanggan_id) }}"
                                       class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('pelanggan.edit', $item->pelanggan_id) }}"
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('pelanggan.destroy', $item->pelanggan_id) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Hapus pelanggan ini?')" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $dataPelanggan->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
