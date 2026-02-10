<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Trip Detail
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

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
                                                {{ $driver->name }}
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
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Place</label>
                                    <input disabled type="text" value="{{ $trip->start_place }}"
                                        class="w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">End Place</label>
                                    <input disabled type="text" value="{{ $trip->end_place }}"
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
