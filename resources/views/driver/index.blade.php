<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Drivers
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class=" flex justify-between mb-6">
                        <div>
                            <a href="{{ route('driver.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 transition">
                                + Create
                            </a>

                        </div>
                    </div>

                    <table id="driversTable" class="display w-full">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Persentase Hasil</th>
                                <th>Tanggungan Koperasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drivers as $driver)
                                <tr onclick="window.location='{{ route('driver.edit', $driver->id) }}'"
                                    class="cursor-pointer hover:bg-gray-100 transition">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $driver->name }}</td>
                                    <td>{{ $driver->persentase_hasil }}%</td>
                                    <td>{{ $driver->tanggungan_koperasi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#driversTable').DataTable();
            });
        </script>
    @endpush

</x-app-layout>
