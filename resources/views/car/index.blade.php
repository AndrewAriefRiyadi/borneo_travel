<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cars') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Create Form --}}
                    <form method="POST" action="{{ route('car.store') }}" class="mb-6">
                        @csrf

                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="flex-1">
                                <input type="text" name="unit_identity" value="{{ old('unit_identity') }}"
                                    placeholder="Input nomor plat (contoh: B 1234 ABC)"
                                    class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>

                                @error('unit_identity')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="inline-flex items-center justify-center px-5 py-2 bg-blue-600 rounded-md text-sm font-semibold text-white hover:bg-blue-700 transition">
                                Create
                            </button>
                        </div>
                    </form>

                    {{-- Table --}}
                    <div class="overflow-x-auto">
                        <table id="carTable" class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b">
                                    <th class="py-3 px-2">No</th>
                                    <th class="py-3 px-2">Unit Identity</th>
                                    <th class="py-3 px-2 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="py-3 px-2">{{ $loop->iteration }}</td>
                                        <td class="py-3 px-2 font-medium">{{ $car->unit_identity }}</td>
                                        <td class="py-3 px-2 text-right">
                                            <form method="POST" action="{{ route('car.delete', $car->id) }}"
                                                onsubmit="return confirm('Yakin mau delete car ini?')" class="inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="inline-flex items-center px-4 py-2 bg-red-600 rounded-md text-sm font-semibold text-white hover:bg-red-700 transition">
                                                    Delete
                                                </button>
                                            </form>
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

    {{-- DataTables Init --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#carTable').DataTable();
        });
    </script>
</x-app-layout>
