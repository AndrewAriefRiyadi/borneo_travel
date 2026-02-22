<x-app-layout>
    <x-slot name="header">
        <div class="flex gap-4 items-center">
            <a href="{{ route('report.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-semibold rounded-md hover:bg-gray-200 transition">
                ← Kembali
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Total Fee Pihak Ketiga per Driver
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

                    <a href="{{ route('report.third-party-fee.print', ['from' => $from, 'to' => $to]) }}"
                        target="_blank" class="px-4 py-2 bg-green-600 text-white rounded-md">
                        Print
                    </a>
                </form>

                {{-- TABLE --}}
                <table id="feeTable" class="min-w-full border mt-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border">Driver</th>
                            <th class="px-4 py-2 border">Total Trip</th>
                            <th class="px-4 py-2 border">Total Fee</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotal = 0; @endphp

                        @foreach ($reports as $report)
                            @php $grandTotal += $report->total_fee; @endphp
                            <tr>
                                <td class="px-4 py-2 border">
                                    {{ $report->driver_name }}
                                </td>
                                <td class="px-4 py-2 border">
                                    {{ $report->total_trip }}
                                </td>
                                <td class="px-4 py-2 border">
                                    Rp {{ number_format($report->total_fee, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50 font-semibold">
                        <tr>
                            <td colspan="2" class="px-4 py-2 border text-right">
                                Grand Total
                            </td>
                            <td class="px-4 py-2 border">
                                Rp {{ number_format($grandTotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>

    @push('scripts')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#feeTable').DataTable({
                    pageLength: 10
                });
            });
        </script>
    @endpush

</x-app-layout>
