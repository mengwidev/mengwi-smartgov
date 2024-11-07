<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print List Kader Bank Sampah</title>
    <link rel="stylesheet" href="{{ asset('css/kader_bank_sampah/style.css') }}">
</head>
<body>
    <h1 class="centered">List Kader Bank Sampah "Yoga Mesari"</h1>
    <h2 class="centered">{{ request('banjar_id') ? "Br. " . $banjar->nama_banjar : 'Desa Mengwi' }}</h2>
    <div class="content">
        <table>
            <thead>
                <tr class="centered">
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kader as $kaders)
                    <tr>
                        <td>{{ $kaders->nama }}</td>
                        <td>{{ $kaders->jabatan->nama_jabatan ?? 'N/A' }}</td>
                        <td>{{ "Br. " . ($kaders->banjar->nama_banjar ?? 'N/A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
