<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trips') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold">Trips</h1>
                        @role('user')
                        <a href="{{ route('trip.create') }}"
                            class="inline-flex items-center px-5 py-2 bg-blue-600 rounded-md text-sm font-semibold text-white hover:bg-blue-700 transition">
                            + Create Trip
                        </a>
                        @endrole
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table id="tripTable" class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b">
                                    <th class="py-3 px-2">No</th>
                                    <th class="py-3 px-2">Departure</th>
                                    <th class="py-3 px-2">Return</th>
                                    <th class="py-3 px-2">Driver</th>
                                    <th class="py-3 px-2">Car</th>
                                    <th class="py-3 px-2">Route 1</th>
                                    <th class="py-3 px-2">Route 2</th>
                                    <th class="py-3 px-2">Status Setoran</th>
                                    <th class="py-3 px-2 text-right">Total Setoran</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($trips as $trip)
                                    <tr class="border-b hover:bg-gray-50 cursor-pointer"
                                        onclick="window.location='{{ route('trip.edit', $trip->id) }}'">
                                        <td class="py-3 px-2">{{ $loop->iteration }}</td>

                                        <td class="py-3 px-2">
                                            {{ \Carbon\Carbon::parse($trip->departure_date)->format('d M Y') }}
                                        </td>

                                        <td class="py-3 px-2">
                                            @if ($trip->return_date)
                                                {{ \Carbon\Carbon::parse($trip->return_date)->format('d M Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td class="py-3 px-2 font-medium">
                                            {{ $trip->driver?->user?->name ?? '-' }}
                                        </td>

                                        <td class="py-3 px-2">
                                            {{ $trip->car?->unit_identity ?? '-' }}
                                        </td>

                                        <td class="py-3 px-2">
                                            {{ $trip->route_1}}
                                        </td>

                                        <td class="py-3 px-2">
                                            {{ $trip->route_2}}
                                        </td>

                                        <td class="py-3 px-2">
                                            {{ $trip->deposit?->payment?->status ?? '-' }}
                                        </td>


                                        <td class="py-3 px-2 text-right font-semibold">
                                            Rp {{ number_format($trip->deposit?->total_deposit, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DataTables --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#tripTable').DataTable({
                pageLength: 10,
                order: [
                    [1, 'desc']
                ] // order by departure date
            });
        });
    </script>
</x-app-layout>
