<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Deposits') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold">Deposits</h1>

                        {{-- <a href="{{ route('deposit.create') }}"
                            class="inline-flex items-center px-5 py-2 bg-blue-600 rounded-md text-sm font-semibold text-white hover:bg-blue-700 transition">
                            + Create deposit
                        </a> --}}
                    </div>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table id="depositTable" class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b">
                                    <th class="py-3 px-2">No</th>
                                    <th class="py-3 px-2">Driver</th>
                                    <th class="py-3 px-2">Total Deposits</th>
                                    <th class="py-3 px-2">Total Driver</th>
                                    <th class="py-3 px-2">Total Company</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($deposits as $deposit)
                                    <tr class="border-b hover:bg-gray-50 cursor-pointer"
                                        onclick="window.location='{{ route('deposit.edit', $deposit->id) }}'">
                                        <td class="py-3 px-2">{{ $loop->iteration }}</td>


                                        <td class="py-3 px-2 font-medium">
                                            {{ $deposit->trip?->driver?->user?->name }}
                                        </td>

                                        <td class="py-3 px-2">
                                            {{ $deposit->total_deposit}}
                                        </td>

                                        <td class="py-3 px-2">
                                            {{ $deposit->total_driver}}
                                        </td>

                                        <td class="py-3 px-2">
                                            {{ $deposit->total_company}}
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
            $('#depositTable').DataTable({
                pageLength: 10,
                order: [
                    [1, 'desc']
                ] // order by departure date
            });
        });
    </script>
</x-app-layout>
