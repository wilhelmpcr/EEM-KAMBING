<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegawai Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-3">Data Pegawai</h1>
        <ul class="list-group">
            <li class="list-group-item"><strong>Nama:</strong> {{ $name }}</li>
            <li class="list-group-item"><strong>Umur:</strong> {{ $my_age }} tahun</li>
            <li class="list-group-item">
                <strong>Hobi:</strong>
                <ul>
                    @foreach ($hobbies as $hobi)
                        <li>{{ $hobi }}</li>
                    @endforeach
                </ul>
            </li>
            <li class="list-group-item"><strong>Tanggal Harus Wisuda:</strong> {{ $tgl_harus_wisuda }}</li>
            <li class="list-group-item"><strong>Jarak Hari Ke Wisuda:</strong> {{ $time_to_study_left }} hari</li>
            <li class="list-group-item"><strong>Semester Saat Ini:</strong> {{ $current_semester }}</li>
            <li class="list-group-item"><strong>Info Semester:</strong> {{ $semester_info }}</li>
            <li class="list-group-item"><strong>Cita-cita:</strong> {{ $future_goal }}</li>
        </ul>
    </div>
</body>
</html>
