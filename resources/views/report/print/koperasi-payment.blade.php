<!DOCTYPE html>
<html>
<head>
    <title>Print Pembayaran Koperasi</title>
    <style>
        body { font-family: Arial; }
        table { width:100%; border-collapse: collapse; margin-top:20px; }
        table, th, td { border:1px solid black; }
        th, td { padding:8px; }
    </style>
</head>
<body onload="window.print()">

    <h2>Total Pembayaran Angsuran Koperasi</h2>
    <p>Periode: {{ $from ?? '-' }} s/d {{ $to ?? '-' }}</p>

    <table>
        <thead>
            <tr>
                <th>Driver</th>
                <th>Total Trip</th>
                <th>Total Dibayar</th>
                <th>Sisa Tanggungan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->driver_name }}</td>
                    <td>{{ $report->total_trip }}</td>
                    <td>Rp {{ number_format($report->total_koperasi_paid,0,',','.') }}</td>
                    <td>Rp {{ number_format($report->tanggungan_koperasi,0,',','.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>