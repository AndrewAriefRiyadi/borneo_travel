<!DOCTYPE html>
<html>

<head>
    <title>Print Rekap Penggunaan Unit</title>
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
            text-align: left;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">

    <h2 class="text-center">Rekap Penggunaan Unit Mobil</h2>
    <p class="text-center">
        Periode: {{ $from }} s/d {{ $to }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Tanggal Berangkat</th>
                <th>Unit</th>
                <th>Driver</th>
                <th>Rute</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trips as $trip)
                <tr>
                    <td>{{ $trip->departure_date }}</td>
                    <td>{{ $trip->car->unit_identity ?? '-' }}</td>
                    <td>{{ $trip->driver->user->name ?? '-' }}</td>
                    <td>
                        {{ $trip->route_1 }}
                        @if ($trip->route_2)
                            - {{ $trip->route_2 }}
                        @endif
                    </td>
                    <td>{{ $trip->return_date ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
