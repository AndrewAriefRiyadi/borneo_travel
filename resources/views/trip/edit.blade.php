<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Trip
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-8">
                        <h1 class="text-2xl font-bold">Edit Trip</h1>

                        <a href="{{ route('trip.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md text-sm font-semibold text-gray-700 hover:bg-gray-300 transition">
                            Back
                        </a>
                    </div>

                    <form action="{{ route('trip.update', $trip->id) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

                        {{-- ================= BASIC INFO ================= --}}
                        <div class="border rounded-lg p-6 bg-gray-50">
                            <h2 class="text-lg font-semibold mb-4">Basic Info</h2>

                            {{-- Driver & Car --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Driver</label>
                                    <select name="driver_id"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                        <option value="">-- Choose Driver --</option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}"
                                                {{ old('driver_id', $trip->driver_id) == $driver->id ? 'selected' : '' }}>
                                                {{ $driver->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Car</label>
                                    <select name="car_id"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                        <option value="">-- Choose Car --</option>
                                        @foreach ($cars as $car)
                                            <option value="{{ $car->id }}"
                                                {{ old('car_id', $trip->car_id) == $car->id ? 'selected' : '' }}>
                                                {{ $car->unit_identity }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Dates --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Departure Date</label>
                                    <input type="date" name="departure_date"
                                        value="{{ old('departure_date', $trip->departure_date) }}"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Return Date</label>
                                    <input type="date" name="return_date"
                                        value="{{ old('return_date', $trip->return_date) }}"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>
                            </div>

                            {{-- Start & End --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Place</label>
                                    <input type="text" name="start_place"
                                        value="{{ old('start_place', $trip->start_place) }}"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">End Place</label>
                                    <input type="text" name="end_place"
                                        value="{{ old('end_place', $trip->end_place) }}"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>
                            </div>

                            {{-- Service Type & Passengers --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Service Type</label>

                                    <select name="service_type"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                        <option value="">-- Choose Service Type --</option>
                                        <option value="Reguler"
                                            {{ old('service_type', $trip->service_type) == 'Reguler' ? 'selected' : '' }}>
                                            Reguler</option>
                                        <option value="Carter"
                                            {{ old('service_type', $trip->service_type) == 'Carter' ? 'selected' : '' }}>
                                            Carter</option>
                                        <option value="Cargo"
                                            {{ old('service_type', $trip->service_type) == 'Cargo' ? 'selected' : '' }}>
                                            Cargo</option>
                                        <option value="Pelayanan"
                                            {{ old('service_type', $trip->service_type) == 'Pelayanan' ? 'selected' : '' }}>
                                            Pelayanan</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Passengers
                                        Amount</label>
                                    <input type="number" name="passengers_amount"
                                        value="{{ old('passengers_amount', $trip->passengers_amount) }}"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>
                            </div>
                        </div>

                        {{-- ================= TRIP FINANCE ================= --}}
                        <div class="border rounded-lg p-6 bg-gray-50">
                            <h2 class="text-lg font-semibold mb-4">Trip Finance</h2>

                            {{-- Departure --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Departure Total</label>
                                    <input type="number" step="0.01" name="departure_total"
                                        value="{{ old('departure_total', $trip->departure_total) }}"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Departure
                                        Description</label>
                                    <input type="text" name="departure_description"
                                        value="{{ old('departure_description', $trip->departure_description) }}"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>
                            </div>

                            {{-- Return --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Return Total</label>
                                    <input type="number" step="0.01" name="return_total"
                                        value="{{ old('return_total', $trip->return_total) }}"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Return
                                        Description</label>
                                    <input type="text" name="return_description"
                                        value="{{ old('return_description', $trip->return_description) }}"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>
                            </div>

                            {{-- Fee & Trip Total --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Fee Total</label>
                                    <input type="number" step="0.01" name="fee_total"
                                        value="{{ old('fee_total', $trip->fee_total) }}"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Trip Total</label>
                                    <input type="number" step="0.01" name="trip_total"
                                        value="{{ old('trip_total', $trip->trip_total) }}"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                </div>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="flex justify-end mt-6">
                            <button type="submit"
                                class="inline-flex items-center px-5 py-2 bg-blue-600 rounded-md text-sm font-semibold text-white hover:bg-blue-700 transition">
                                Update Trip
                            </button>
                        </div>

                    </form>

                    {{-- Delete button (di luar form supaya tidak nested) --}}
                    <div class="mt-4 flex justify-start">
                        <form action="{{ route('trip.delete', $trip->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this trip?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="inline-flex items-center px-5 py-2 bg-red-600 rounded-md text-sm font-semibold text-white hover:bg-red-700 transition">
                                Delete Trip
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
