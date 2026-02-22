<!DOCTYPE html>
<html>

<head>
    <title>Print Total Fee Pihak Ketiga</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
        }
    </style>
</head>

<body onload="window.print()">

    <h2>Total Fee Pihak Ketiga per Driver</h2>
    <p>Periode: {{ $from ?? '-' }} s/d {{ $to ?? '-' }}</p>
    <p>Tanggal Cetak: {{ now()->format('d-m-Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Driver</th>
                <th>Total Trip</th>
                <th>Total Fee</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp

            @foreach ($reports as $report)
                @php $grandTotal += $report->total_fee; @endphp
                <tr>
                    <td>{{ $report->driver_name }}</td>
                    <td>{{ $report->total_trip }}</td>
                    <td>Rp {{ number_format($report->total_fee, 0, ',', '.') }}</td>
                </tr>
            @endforeach

            <tr>
                <th colspan="2">Grand Total</th>
                <th>Rp {{ number_format($grandTotal, 0, ',', '.') }}</th>
            </tr>
        </tbody>
    </table>

</body>

</html>
