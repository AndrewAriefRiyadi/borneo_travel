<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Trip Detail
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 mb-6">
                
                {{-- Tombol Liat Setoran --}}
                <a href="{{ route('deposit.edit', $trip->deposit->id) }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md text-sm font-semibold text-white hover:bg-gray-700 transition">
                    Liat Setoran
                </a>

                {{-- Badge Status Payment --}}
                @php
                    $paymentStatus = $trip->deposit?->payment?->status ?? null;
                @endphp

                @if (!$paymentStatus)
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-800">
                        Belum Bayar
                    </span>
                @elseif ($paymentStatus === 'draft')
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-200 text-yellow-900">
                        Pending
                    </span>
                @elseif ($paymentStatus === 'lunas')
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-200 text-green-900">
                        Lunas
                    </span>
                @else
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-200 text-red-900">
                        Unknown
                    </span>
                @endif
            </div>


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-8">
                        <h1 class="text-2xl font-bold">Trip Detail</h1>

                        <a href="{{ route('trip.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 rounded-md text-sm font-semibold text-gray-700 hover:bg-gray-300 transition">
                            Back
                        </a>
                    </div>

                    {{-- FORM --}}
                    <form class="space-y-8">

                        {{-- ================= BASIC INFO ================= --}}
                        <div class="border rounded-lg p-6 bg-gray-50">
                            <h2 class="text-lg font-semibold mb-4">Basic Info</h2>

                            {{-- Driver & Car --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Driver</label>
                                    <select disabled
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 bg-gray-100 cursor-not-allowed">
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}"
                                                {{ $trip->driver_id == $driver->id ? 'selected' : '' }}>
                                                {{ $driver->user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Car</label>
                                    <select disabled
                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 bg-gray-100 cursor-not-allowed">
                                        @foreach ($cars as $car)
                                            <option value="{{ $car->id }}"
                                                {{ $trip->car_id == $car->id ? 'selected' : '' }}>
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
                                    <input disabled type="date" value="{{ $trip->departure_date }}"
                                        class="w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Return Date</label>
                                    <input disabled type="date" value="{{ $trip->return_date }}"
                                        class="w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed">
                                </div>
                            </div>

                            {{-- Start & End --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Route 1</label>
                                    <input disabled type="text" value="{{ $trip->route_1 }}"
                                        class="w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Route 2</label>
                                    <input disabled type="text" value="{{ $trip->route_2 }}"
                                        class="w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed">
                                </div>
                            </div>

                            {{-- Service Type & Passengers --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Service Type</label>
                                    <select disabled
                                        class="w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed">
                                        <option selected>{{ $trip->service_type }}</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Passengers
                                        Amount</label>
                                    <input disabled type="number" value="{{ $trip->passengers_amount }}"
                                        class="w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed">
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
                                    <input disabled type="number" value="{{ $trip->departure_total }}"
                                        class="w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Departure
                                        Description</label>
                                    <input disabled type="text" value="{{ $trip->departure_description }}"
                                        class="w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed">
                                </div>
                            </div>

                            {{-- Return --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Return Total</label>
                                    <input disabled type="number" value="{{ $trip->return_total }}"
                                        class="w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Return
                                        Description</label>
                                    <input disabled type="text" value="{{ $trip->return_description }}"
                                        class="w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed">
                                </div>
                            </div>

                            {{-- Fee & Trip Total --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Fee Total</label>
                                    <input disabled type="number" value="{{ $trip->fee_total }}"
                                        class="w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Trip Total</label>
                                    <input disabled type="number" value="{{ $trip->trip_total }}"
                                        class="w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed">
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
                                    <input type="number" step="0.01" value="{{ $trip->cost->bbm_total ?? 0 }}"
                                        disabled class="w-full rounded-md border-gray-300 bg-gray-100">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">BBM Attachment</label>

                                    @if (!empty($trip->cost->bbm_attachment))
                                        <a href="{{ asset('storage/' . $trip->cost->bbm_attachment) }}" target="_blank"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md text-sm font-semibold text-white hover:bg-gray-700 transition">
                                            View Attachment
                                        </a>
                                    @else
                                        <p class="text-sm text-gray-500">No attachment</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Wash --}}
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Wash Total</label>
                                <input type="number" step="0.01" value="{{ $trip->cost->wash_total ?? 0 }}"
                                    disabled class="w-full rounded-md border-gray-300 bg-gray-100">
                            </div>

                            {{-- Parking --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Parking Total</label>
                                    <input type="number" step="0.01"
                                        value="{{ $trip->cost->parking_total ?? 0 }}" disabled
                                        class="w-full rounded-md border-gray-300 bg-gray-100">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Parking
                                        Attachment</label>

                                    @if (!empty($trip->cost->parking_attachment))
                                        <a href="{{ asset('storage/' . $trip->cost->parking_attachment) }}"
                                            target="_blank"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md text-sm font-semibold text-white hover:bg-gray-700 transition">
                                            View Attachment
                                        </a>
                                    @else
                                        <p class="text-sm text-gray-500">No attachment</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Repair --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Repair Total</label>
                                    <input type="number" step="0.01"
                                        value="{{ $trip->cost->repair_total ?? 0 }}" disabled
                                        class="w-full rounded-md border-gray-300 bg-gray-100">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Repair
                                        Attachment</label>

                                    @if (!empty($trip->cost->repair_attachment))
                                        <a href="{{ asset('storage/' . $trip->cost->repair_attachment) }}"
                                            target="_blank"
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md text-sm font-semibold text-white hover:bg-gray-700 transition">
                                            View Attachment
                                        </a>
                                    @else
                                        <p class="text-sm text-gray-500">No attachment</p>
                                    @endif
                                </div>
                            </div>

                            {{-- Cost Total --}}
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Cost Total</label>
                                <input type="number" step="0.01" value="{{ $trip->cost->cost_total ?? 0 }}"
                                    disabled class="w-full rounded-md border-gray-300 bg-gray-100">
                            </div>
                        </div>


                    </form>
                    {{-- Delete button (di luar form supaya tidak nested) --}}
                    {{-- <div class="mt-4 flex justify-start">
                        <form action="{{ route('trip.delete', $trip->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this trip?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="inline-flex items-center px-5 py-2 bg-red-600 rounded-md text-sm font-semibold text-white hover:bg-red-700 transition">
                                Delete Trip
                            </button>
                        </form>
                    </div> --}}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
