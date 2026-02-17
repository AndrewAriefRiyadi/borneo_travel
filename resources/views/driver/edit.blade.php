<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Drivers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold">Edit Driver</h1>

                        <a href="{{ route('driver.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md text-sm font-semibold text-white hover:bg-gray-700 transition">
                            Back
                        </a>
                    </div>

                    <form method="POST" action="{{ route('driver.update', $driver->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- USER ACCOUNT --}}
                        <div class="border rounded-lg p-4">
                            <h2 class="font-semibold text-lg mb-4">User Account</h2>

                            {{-- User Name --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    User Name
                                </label>
                                <input type="text" name="user_name"
                                    value="{{ old('user_name', $driver->user->name) }}"
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
                                <input type="email" name="email" value="{{ old('email', $driver->user->email) }}"
                                    class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                @error('email')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Password (optional) --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Password (optional)
                                </label>
                                <input type="password" name="password"
                                    class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <p class="text-xs text-gray-500 mt-1">
                                    Kosongkan jika tidak ingin mengubah password.
                                </p>

                                @error('password')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <input type="hidden" name="role" value="user">
                        </div>


                        {{-- DRIVER DATA --}}
                        <div class="border rounded-lg p-4">
                            <h2 class="font-semibold text-lg mb-4">Driver Data</h2>

                            {{-- Persentase Hasil --}}
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Persentase Hasil
                                </label>
                                <select name="persentase_hasil"
                                    class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                                    <option value="40"
                                        {{ old('persentase_hasil', $driver->persentase_hasil) == 40 ? 'selected' : '' }}>
                                        40%</option>
                                    <option value="45"
                                        {{ old('persentase_hasil', $driver->persentase_hasil) == 45 ? 'selected' : '' }}>
                                        45%</option>
                                    <option value="50"
                                        {{ old('persentase_hasil', $driver->persentase_hasil) == 50 ? 'selected' : '' }}>
                                        50%</option>
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
                                    value="{{ old('tanggungan_koperasi', $driver->tanggungan_koperasi) }}"
                                    class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    min="0" required>
                                @error('tanggungan_koperasi')
                                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="flex justify-between items-center">
                            <form method="POST" action="{{ route('driver.delete', $driver->id) }}"
                                onsubmit="return confirm('Yakin mau delete driver ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="inline-flex items-center px-5 py-2 bg-red-600 rounded-md text-sm font-semibold text-white hover:bg-red-700 transition">
                                    Delete Driver
                                </button>
                            </form>

                            <button type="submit"
                                class="inline-flex items-center px-5 py-2 bg-blue-600 rounded-md text-sm font-semibold text-white hover:bg-blue-700 transition">
                                Update Driver
                            </button>
                        </div>



                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
