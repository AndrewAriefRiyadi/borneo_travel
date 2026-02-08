<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trips') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold">Create Trip</h1>

                        <a href="{{ route('trip.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md text-sm font-semibold text-white hover:bg-gray-700 transition">
                            Back
                        </a>
                    </div>

                    <form method="POST" action="{{ route('trip.store') }}" class="space-y-6" x-data="{
                        departure_total: {{ old('departure_total', 0) }},
                        return_total: {{ old('return_total', 0) }},
                        fee_total: {{ old('fee_total', 0) }},
                        get trip_total() {
                            return (Number(this.departure_total) || 0) +
                                (Number(this.return_total) || 0) +
                                (Number(this.fee_total) || 0);
                        }
                    }">
                        @csrf

                        {{-- Basic --}}
                        <div class="border rounded-lg p-4">
                            <h2 class="font-semibold text-lg mb-4">Basic Info</h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                {{-- Departure Date --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Departure Date
                                    </label>
                                    <input type="date" name="departure_date" value="{{ old('departure_date') }}"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                    @error('departure_date')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Return Date --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Return Date
                                    </label>
                                    <input type="date" name="return_date" value="{{ old('return_date') }}"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                    @error('return_date')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Driver --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Driver
                                    </label>
                                    <select name="driver_id"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                        <option value="">-- Choose Driver --</option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}"
                                                {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                                {{ $driver->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('driver_id')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Car --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Car (Unit Identity)
                                    </label>
                                    <select name="car_id"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                        <option value="">-- Choose Car --</option>
                                        @foreach ($cars as $car)
                                            <option value="{{ $car->id }}"
                                                {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                                {{ $car->unit_identity }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('car_id')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Start Place --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Start Place
                                    </label>
                                    <input type="text" name="start_place" value="{{ old('start_place') }}"
                                        placeholder="Contoh: Bontang"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                    @error('start_place')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- End Place --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        End Place
                                    </label>
                                    <input type="text" name="end_place" value="{{ old('end_place') }}"
                                        placeholder="Contoh: Samarinda"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                    @error('end_place')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Service Type --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Service Type
                                    </label>
                                    <select name="service_type"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                        <option value="">-- Choose Service Type --</option>
                                        <option value="Reguler">Reguler</option>
                                        <option value="Carter">Carter</option>
                                        <option value="Cargo">Cargo</option>
                                        <option value="Pelayanan">Pelayanan</option>
                                    </select>
                                </div>

                                {{-- Passengers --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Passengers Amount
                                    </label>
                                    <input type="number" name="passengers_amount"
                                        value="{{ old('passengers_amount') }}" min="1"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                    @error('passengers_amount')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Finance --}}
                        <div class="border rounded-lg p-4">
                            <h2 class="font-semibold text-lg mb-4">Trip Finance</h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                                {{-- Departure Total --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Departure Total
                                    </label>
                                    <input type="number" name="departure_total" x-model="departure_total"
                                        min="0" step="0.01"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                    @error('departure_total')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Departure Desc --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Departure Description
                                    </label>
                                    <input type="text" name="departure_description"
                                        value="{{ old('departure_description') }}" placeholder="Contoh: Tol + parkir"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        >
                                    @error('departure_description')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Return Total --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Return Total
                                    </label>
                                    <input type="number" name="return_total" x-model="return_total" min="0"
                                        step="0.01"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                    @error('return_total')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Return Desc --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Return Description
                                    </label>
                                    <input type="text" name="return_description"
                                        value="{{ old('return_description') }}" placeholder="Contoh: BBM"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        >
                                    @error('return_description')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Fee Total --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Fee Total
                                    </label>
                                    <input type="number" name="fee_total" x-model="fee_total" min="0"
                                        step="0.01"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                    @error('fee_total')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Trip Total (auto) --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Trip Total (Auto)
                                    </label>
                                    <input type="number" :value="trip_total"
                                        class="w-full rounded-md border-gray-200 bg-gray-100" readonly>

                                    <p class="text-xs text-gray-500 mt-1">
                                        Otomatis dihitung dari departure + return + fee.
                                    </p>
                                </div>

                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2 bg-blue-600 rounded-md text-sm font-semibold text-white hover:bg-blue-700 transition">
                                Create Trip
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
