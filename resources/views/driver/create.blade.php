<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Drivers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold">Create Driver</h1>

                        <a href="{{ route('driver.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md text-sm font-semibold text-white hover:bg-gray-700 transition">
                            Back
                        </a>
                    </div>
                    <form method="POST" action="{{ route('driver.store') }}" class="space-y-6">
                        @csrf

                        {{-- USER ACCOUNT --}}
                        <div class="border rounded-lg p-4">
                            <h2 class="font-semibold text-lg mb-4">User Account</h2>

                            {{-- Name --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Name
                                </label>
                                <input type="text" name="user_name" value="{{ old('user_name') }}"
                                    class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                @error('user_name')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Email
                                </label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                @error('email')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Password
                                </label>
                                <input type="password" name="password"
                                    class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                @error('password')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>


                        {{-- DRIVER DATA --}}
                        <div class="border rounded-lg p-4">
                            <h2 class="font-semibold text-lg mb-4">Driver Data</h2>

                            {{-- Driver Name --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Driver Name
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                @error('name')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Persentase Hasil --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Persentase Hasil
                                </label>
                                <select name="persentase_hasil"
                                    class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                    <option value="">-- pilih --</option>
                                    <option value="40" {{ old('persentase_hasil') == 40 ? 'selected' : '' }}>40%
                                    </option>
                                    <option value="45" {{ old('persentase_hasil') == 45 ? 'selected' : '' }}>45%
                                    </option>
                                    <option value="50" {{ old('persentase_hasil') == 50 ? 'selected' : '' }}>50%
                                    </option>
                                </select>
                                @error('persentase_hasil')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tanggungan Koperasi --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Tanggungan Koperasi
                                </label>
                                <input type="number" name="tanggungan_koperasi"
                                    value="{{ old('tanggungan_koperasi', 0) }}"
                                    class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    min="0" required>
                                @error('tanggungan_koperasi')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-5 py-2 bg-blue-600 rounded-md text-sm font-semibold text-white hover:bg-blue-700 transition">
                                Save Driver
                            </button>
                        </div>
                    </form>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
