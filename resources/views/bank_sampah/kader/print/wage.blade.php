<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print List Kader Bank Sampah</title>
    <link rel="stylesheet" href="{{ asset('css/kader_bank_sampah/style.css') }}">
    <style>
        * {
            font-size: 12pt;
            margin: 0;
            padding: 0;
        }

        h1,h2,h3,h4,h5,h6 {
            margin-bottom: 5pt;
        }

        h1 {
            font-size: 22pt;
            
        }

        h2 {
            font-size: 20pt;
        }

        h3 {
            font-size: 18pt;
        }

        h4 {
            font-size: 16pt;
        }

        h5 {
            font-size: 14pt;
        }

        th,td {
            text-align: center;
        }

        .no-center {
            text-align: left;
        }
        
        .sign {
            //background: red;
            margin-top: 30pt;
            height: 90pt;
            width: 40%;
            float: right;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="title">
        <h5 class="centered">DAFTAR PENERIMAAN HONOR KADER BANK SAMPAH</h5>
        <h5 class="centered">{{ request('banjar_id') ? "BR. " . strtoupper($banjar->nama_banjar) : strtoupper('Desa Mengwi') }}</h5>
        <h5 class="centered">DESA MENGWI TAHUN ANGGARAN 2024</h5>
    </div>
    
    <div class="content">
        <h6>{{ request('month_id') ? "BULAN " . strtoupper($month->nama_bulan) . " TAHUN 2024" : "No Month Selected" }}</h6>
        <table>
            <thead>
                <tr class="centered" style="text-align: center">
                    <th>No</th>
                    <th style="width: 180pt">Nama</th>
                    <th style="width: 100pt">Yang Diterima</th>
                    <th style="width: 90pt">Jumlah Total</th>
                    <th style="width: 80pt">PPh PS. 21 5% (Rp)</th>
                    <th style="width: 100pt">Jumlah Diterima</th>
                    <th style="width: 50pt">Tanda Tangan</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalAmountSum = 0;
                    $taxAmountSum = 0;
                    $netAmountSum = 0;
                    $indexNum = 1; // Initialize the index counter outside the loop
                @endphp
            
                @foreach ($kader as $kaders)
                    @php
                        $honor = $bankSampahConfig->honor;
                        $taxRate = $bankSampahConfig->tax / 100;
                        $multiplier = 2;
                        $totalAmount = $honor * $multiplier;
                        $taxAmount = $totalAmount * $taxRate;
                        $netAmount = $totalAmount - $taxAmount;
            
                        // Add to totals
                        $totalAmountSum += $totalAmount;
                        $taxAmountSum += $taxAmount;
                        $netAmountSum += $netAmount;
                    @endphp
                    <tr>
                        <td>{{ $indexNum }}</td> <!-- Display the index -->
                        <td class="no-center">{{ Str::title($kaders->nama) }}</td>
                        <td>Rp {{ number_format($honor, 0, ',', '.') }} x {{ $multiplier }}</td>
                        <td>Rp {{ number_format($totalAmount, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($taxAmount, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($netAmount, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                    @php
                        $indexNum++; // Increment the index counter
                    @endphp
                @endforeach
            </tbody>            
            
            <tfoot>
                <tr>
                    <th colspan="3">Jumlah</th>
                    <th>Rp {{ number_format($totalAmountSum, 0, ',', '.') }}</th> <!-- Sum of $totalAmount -->
                    <th>Rp {{ number_format($taxAmountSum, 0, ',', '.') }}</th> <!-- Sum of $taxAmount -->
                    <th class="no-center" colspan="2">Rp {{ number_format($netAmountSum, 0, ',', '.') }}</th> <!-- Sum of $netAmount -->
                </tr>
            </tfoot>            
        </table>

        <div class="sign">
            <span>Pelaksana Kegiatan</span>
            <span>I Nyoman Bagunada</span>
        </div>
    </div>
</body>
</html>
