<x-app-layout>
    <x-slot name="header">
        <div class="flex gap-4 items-center">
            <a href="{{ route('report.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-semibold rounded-md hover:bg-gray-200 transition">
                ← Kembali
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Laporan Pemasukan Driver
            </h2>


        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- FILTER --}}
                <form method="GET" class="mb-6 flex gap-4 items-end">
                    <div>
                        <label class="block text-sm text-gray-600">Dari</label>
                        <input type="date" name="from" value="{{ $from }}"
                            class="border rounded-md px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600">Sampai</label>
                        <input type="date" name="to" value="{{ $to }}"
                            class="border rounded-md px-3 py-2">
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">
                        Filter
                    </button>

                    <a href="{{ route('report.driver-income.print', ['from' => $from, 'to' => $to]) }}" target="_blank"
                        class="px-4 py-2 bg-green-600 text-white rounded-md">
                        Print
                    </a>
                </form>


                {{-- TABLE --}}
                <table id="reportTable" class="min-w-full border mt-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">Driver</th>
                            <th class="px-4 py-2 border">Total Pemasukan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td class="px-4 py-2 border">
                                    {{ $report->driver_name }}
                                </td>
                                <td class="px-4 py-2 border">
                                    Rp {{ number_format($report->total_income, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- DataTables CDN --}}
    @push('scripts')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#reportTable').DataTable();
            });
        </script>
    @endpush

</x-app-layout>
