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

                        <a href="{{ route('my-trips.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md text-sm font-semibold text-white hover:bg-gray-700 transition">
                            Back
                        </a>
                    </div>


                    <form method="POST" action="{{ route('trip.store') }}" class="space-y-6" x-data="{
                        // Trip Total
                        departure_total: {{ old('departure_total', 0) }},
                        return_total: {{ old('return_total', 0) }},
                        fee_total: {{ old('fee_total', 0) }},
                        lunas_kantor: {{ old('lunas_kantor', 0) }},
                    
                        get trip_total() {
                            return (Number(this.departure_total) || 0) +
                                (Number(this.return_total) || 0) +
                                (Number(this.fee_total) || 0) -
                                (Number(this.lunas_kantor) || 0);
                        },
                    
                        // Cost Total
                        bbm_total: {{ old('bbm_total', 0) }},
                        wash_total: {{ old('wash_total', 0) }},
                        parking_total: {{ old('parking_total', 0) }},
                        repair_total: {{ old('repair_total', 0) }},
                        makan_total: {{ old('makan_total', 0) }},
                        pom_total: {{ old('pom_total', 0) }},
                    
                        get cost_total() {
                            return (Number(this.bbm_total) || 0) +
                                (Number(this.wash_total) || 0) +
                                (Number(this.parking_total) || 0) +
                                (Number(this.repair_total) || 0) +
                                (Number(this.makan_total) || 0) +
                                (Number(this.pom_total) || 0);
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
                                    <input type="hidden" name="driver_id" value="{{ $driver->id }}">
                                    <input type="text" name="driver" value="{{ $driver->user?->name }}"
                                        
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        readonly required>
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

                                {{-- Route 1 --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Route 1
                                    </label>

                                    <select name="route_1"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                        <option value="">-- Choose Route --</option>

                                        <option value="Bontang – Samarinda"
                                            {{ old('route_1') == 'Bontang – Samarinda' ? 'selected' : '' }}>
                                            Bontang – Samarinda
                                        </option>
                                        <option value="Bontang – Balikpapan"
                                            {{ old('route_1') == 'Bontang – Balikpapan' ? 'selected' : '' }}>
                                            Bontang – Balikpapan
                                        </option>
                                        <option value="Bontang – Sangatta"
                                            {{ old('route_1') == 'Bontang – Sangatta' ? 'selected' : '' }}>
                                            Bontang – Sangatta
                                        </option>
                                        <option value="Samarinda – Bontang"
                                            {{ old('route_1') == 'Samarinda – Bontang' ? 'selected' : '' }}>
                                            Samarinda – Bontang
                                        </option>
                                        <option value="Samarinda – Sangatta"
                                            {{ old('route_1') == 'Samarinda – Sangatta' ? 'selected' : '' }}>
                                            Samarinda – Sangatta
                                        </option>
                                        <option value="Samarinda – Balikpapan"
                                            {{ old('route_1') == 'Samarinda – Balikpapan' ? 'selected' : '' }}>
                                            Samarinda – Balikpapan
                                        </option>
                                        <option value="Balikpapan – Bontang"
                                            {{ old('route_1') == 'Balikpapan – Bontang' ? 'selected' : '' }}>
                                            Balikpapan – Bontang
                                        </option>
                                        <option value="Balikpapan – Samarinda"
                                            {{ old('route_1') == 'Balikpapan – Samarinda' ? 'selected' : '' }}>
                                            Balikpapan – Samarinda
                                        </option>
                                        <option value="Balikpapan – Sangatta"
                                            {{ old('route_1') == 'Balikpapan – Sangatta' ? 'selected' : '' }}>
                                            Balikpapan – Sangatta
                                        </option>
                                        <option value="Dalam Kota"
                                            {{ old('route_1') == 'Dalam Kota' ? 'selected' : '' }}>
                                            Dalam Kota
                                        </option>
                                    </select>

                                    @error('route_1')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Route 2 --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Route 2
                                    </label>

                                    <select name="route_2"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>
                                        <option value="">-- Choose Route --</option>

                                        <option value="Bontang – Samarinda"
                                            {{ old('route_2') == 'Bontang – Samarinda' ? 'selected' : '' }}>
                                            Bontang – Samarinda
                                        </option>
                                        <option value="Bontang – Balikpapan"
                                            {{ old('route_2') == 'Bontang – Balikpapan' ? 'selected' : '' }}>
                                            Bontang – Balikpapan
                                        </option>
                                        <option value="Bontang – Sangatta"
                                            {{ old('route_2') == 'Bontang – Sangatta' ? 'selected' : '' }}>
                                            Bontang – Sangatta
                                        </option>
                                        <option value="Samarinda – Bontang"
                                            {{ old('route_2') == 'Samarinda – Bontang' ? 'selected' : '' }}>
                                            Samarinda – Bontang
                                        </option>
                                        <option value="Samarinda – Sangatta"
                                            {{ old('route_2') == 'Samarinda – Sangatta' ? 'selected' : '' }}>
                                            Samarinda – Sangatta
                                        </option>
                                        <option value="Samarinda – Balikpapan"
                                            {{ old('route_2') == 'Samarinda – Balikpapan' ? 'selected' : '' }}>
                                            Samarinda – Balikpapan
                                        </option>
                                        <option value="Balikpapan – Bontang"
                                            {{ old('route_2') == 'Balikpapan – Bontang' ? 'selected' : '' }}>
                                            Balikpapan – Bontang
                                        </option>
                                        <option value="Balikpapan – Samarinda"
                                            {{ old('route_2') == 'Balikpapan – Samarinda' ? 'selected' : '' }}>
                                            Balikpapan – Samarinda
                                        </option>
                                        <option value="Balikpapan – Sangatta"
                                            {{ old('route_2') == 'Balikpapan – Sangatta' ? 'selected' : '' }}>
                                            Balikpapan – Sangatta
                                        </option>
                                        <option value="Dalam Kota"
                                            {{ old('route_2') == 'Dalam Kota' ? 'selected' : '' }}>
                                            Dalam Kota
                                        </option>
                                    </select>

                                    @error('route_2')
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
                                        value="{{ old('departure_description') }}" placeholder=""
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
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
                                        value="{{ old('return_description') }}" placeholder=""
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
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
                                        >
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
                                        Otomatis dihitung dari departure + return + fee - lunas kantor.
                                    </p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Lunas Kantor
                                    </label>
                                    <input type="number" name="lunas_kantor" x-model="lunas_kantor" min="0"
                                        step="0.01"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        >
                                    @error('lunas_kantor')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        {{-- ================= COST DETAIL ================= --}}
                        <div class="border rounded-lg p-6 bg-gray-50">
                            <h2 class="text-lg font-semibold mb-4">Cost Detail</h2>

                            {{-- BBM --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">BBM Total</label>
                                    <input type="number" step="0.01" name="bbm_total" x-model="bbm_total"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>


                                    @error('bbm_total')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">BBM Attachment</label>
                                    <input type="file" name="bbm_attachment"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                                    @error('bbm_attachment')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- makan --}}
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Makan Total</label>
                                <input type="number" step="0.01" name="makan_total" x-model="makan_total"
                                    class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>


                                @error('makan_total')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Wash --}}
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Wash Total</label>
                                <input type="number" step="0.01" name="wash_total" x-model="wash_total"
                                    class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>


                                @error('wash_total')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Parking --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Parking Total</label>
                                    <input type="number" step="0.01" name="parking_total"
                                        x-model="parking_total"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>


                                    @error('parking_total')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Parking
                                        Attachment</label>
                                    <input type="file" name="parking_attachment"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                                    @error('parking_attachment')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Repair --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Repair Total</label>
                                    <input type="number" step="0.01" name="repair_total" x-model="repair_total"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                        required>


                                    @error('repair_total')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Repair
                                        Attachment</label>
                                    <input type="file" name="repair_attachment"
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                                    @error('repair_attachment')
                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">POM Total</label>
                                <input type="number" step="0.01" name="pom_total" x-model="pom_total"
                                    class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>


                                @error('pom_total')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Cost Total --}}
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Cost Total</label>
                                <input type="number" step="0.01" name="cost_total" :value="cost_total.toFixed(2)"
                                    readonly
                                    class="w-full rounded-md border-gray-300 bg-gray-100 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>

                                <p class="text-xs text-gray-500 mt-1">
                                    Otomatis dihitung dari semua biaya.
                                </p>
                                @error('cost_total')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
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
