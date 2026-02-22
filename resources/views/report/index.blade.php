<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laporan') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6">
                    <p class="text-gray-600">
                        Pilih jenis laporan yang ingin Anda lihat.
                        Setiap laporan dapat difilter berdasarkan tanggal, driver, atau unit kendaraan.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    {{-- Pemasukan Driver --}}
                    <a href="{{ route('report.driver-income') }}"
                        class="block p-6 border rounded-xl hover:shadow-md transition">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            Pemasukan Driver
                        </h3>
                        <p class="text-sm text-gray-600">
                            Total pemasukan masing-masing driver dalam periode tertentu.
                        </p>
                    </a>

                    {{-- Nota Bengkel --}}
                    <a href="{{ route('report.repair-recap') }}"
                        class="block p-6 border rounded-xl hover:shadow-md transition">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            Nota Bengkel per Unit
                        </h3>
                        <p class="text-sm text-gray-600">
                            Rekap biaya perbaikan dan maintenance kendaraan per unit.
                        </p>
                    </a>

                    {{-- Fee Pihak Ketiga --}}
                    <a href="{{ route('report.third-party-fee') }}"
                        class="block p-6 border rounded-xl hover:shadow-md transition">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            Fee Pihak Ketiga
                        </h3>
                        <p class="text-sm text-gray-600">
                            Total fee pihak ketiga dari masing-masing driver.
                        </p>
                    </a>

                    {{-- Angsuran Koperasi --}}
                    <a href="{{ route('report.koperasi-payment') }}"
                        class="block p-6 border rounded-xl hover:shadow-md transition">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            Angsuran Koperasi Driver
                        </h3>
                        <p class="text-sm text-gray-600">
                            Rekap pembayaran angsuran koperasi per driver.
                        </p>
                    </a>

                    {{-- Penggunaan Unit --}}
                    <a href="{{ route('report.car-usage') }}"
                        class="block p-6 border rounded-xl hover:shadow-md transition">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            Penggunaan Unit Kendaraan
                        </h3>
                        <p class="text-sm text-gray-600">
                            Riwayat penggunaan unit berdasarkan tanggal dan driver.
                        </p>
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
