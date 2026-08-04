<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>

        body{
            font-family: DejaVu Sans;
            font-size:12px;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table,th,td{
            border:1px solid #000;
        }

        th,td{
            padding:8px;
        }

        h2{
            text-align:center;
        }

    </style>

</head>

<body>

<h2>Riwayat Kalkulator Gizi Anak</h2>

@if($tanggal)
<p>
Tanggal Tes :
<b>{{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}</b>
</p>
@endif

<table>

<thead>

<tr>
    <th>No</th>
    <th>Nama Anak</th>
    <th>Umur</th>
    <th>Berat</th>
    <th>Tinggi</th>
    <th>Status Gizi</th>
    <th>Tanggal Tes</th>
</tr>

</thead>

<tbody>

@foreach($riwayat as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->dataAnak->nama_anak ?? '-' }}</td>

<td>{{ $item->umur }} bulan</td>

<td>{{ $item->berat }} kg</td>

<td>{{ $item->tinggi }} cm</td>

<td>{{ $item->hasil_prediksi }}</td>

<td>{{ $item->created_at->format('d-m-Y') }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>
</html>