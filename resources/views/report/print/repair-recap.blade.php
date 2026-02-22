<body onload="window.print()">
    <h2>Rekap Biaya Perbaikan Kendaraan</h2>
    <p>Periode: {{ $from ?? '-' }} s/d {{ $to ?? '-' }}</p>

    <table border="1" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Unit</th>
                <th>Total Nota</th>
                <th>Total Perbaikan</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp

            @foreach($reports as $r)
                @php $grandTotal += $r->total_repair; @endphp
                <tr>
                    <td>{{ $r->unit_identity }}</td>
                    <td>{{ $r->total_nota }}</td>
                    <td>
                        Rp {{ number_format($r->total_repair,0,',','.') }}
                    </td>
                </tr>
            @endforeach

            <tr>
                <th colspan="2">Grand Total</th>
                <th>
                    Rp {{ number_format($grandTotal,0,',','.') }}
                </th>
            </tr>
        </tbody>
    </table>
</body>