<!DOCTYPE html>
<html>
<head>
    <title>Print Driver Income</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        @media print {
            button {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <h2>Laporan Pemasukan Driver</h2>
    <p>Periode: {{ $from ?? '-' }} s/d {{ $to ?? '-' }}</p>
    <p>Tanggal Cetak: {{ now()->format('d-m-Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Driver</th>
                <th>Total Income</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp

            @foreach($reports as $r)
                @php $grandTotal += $r->total_income; @endphp
                <tr>
                    <td>{{ $r->driver_name }}</td>
                    <td class="text-right">
                        Rp {{ number_format($r->total_income,0,',','.') }}
                    </td>
                </tr>
            @endforeach

            <tr>
                <th>Grand Total</th>
                <th class="text-right">
                    Rp {{ number_format($grandTotal,0,',','.') }}
                </th>
            </tr>
        </tbody>
    </table>

</body>
</html>