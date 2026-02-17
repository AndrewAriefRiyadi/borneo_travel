<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Deposits') }}
        </h2>
    </x-slot>

    @php
        // helper format rupiah/angka
        $fmt = function ($value) {
            return number_format((float) ($value ?? 0), 0, ',', '.');
        };

        $tripTotal = $deposit->trip?->trip_total ?? 0;

        $fee = $deposit->trip?->fee_total ?? 0;

        $bbm = $deposit->trip?->cost?->bbm_total ?? 0;
        $makan = $deposit->trip?->cost?->makan_total ?? 0;
        $wash = $deposit->trip?->cost?->wash_total ?? 0;
        $parking = $deposit->trip?->cost?->parking_total ?? 0;
        $repair = $deposit->trip?->cost?->repair_total ?? 0;
        $pom = $deposit->trip?->cost?->pom_total ?? 0;

        $sisa1 = $tripTotal - $fee - $bbm;
        $sisa2 = $sisa1 - $makan;
        $sisa3 = $sisa2 - $wash;
        $sisa4 = $sisa3 - $parking;
        $sisa5 = $sisa4 - $repair;
        $sisa6 = $sisa5 - $pom;
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-2 mb-6 items-center">
                <span class="text-sm font-medium text-gray-700">Status Setoran:</span>
                @if ($deposit->status === 'Approved')
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                        Approved
                    </span>
                @else
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700 border border-yellow-200">
                        Pending
                    </span>
                @endif
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Header --}}
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-bold">Deposit</h1>
                    </div>

                    <div class="flex w-full justify-center border ">
                        {{-- KIRI --}}
                        <div class="flex flex-col mr-1  w-fit text-end">
                            <p class="text-start">Tgl</p>
                            <p>{{ $deposit->trip?->departure_date }}</p>
                            <p>{{ $deposit->trip?->return_date }}</p>

                            <div class="block">&nbsp;</div>

                            <p class="text-start bg-slate-200">Bengkel</p>
                            <p class=" bg-slate-200">{{ $fmt($deposit->trip?->cost?->repair_total) }}</p>

                            <div class="block">&nbsp;</div>

                            {{-- <p class="text-start bg-orange-200">Titip Service Motor</p>
                            <p class=" bg-orange-200">{{ $fmt(99999) }}</p> --}}
                        </div>

                        {{-- TENGAH --}}
                        <div class="flex flex-col  w-fit">
                            <p>{{ $deposit->trip?->driver?->user->name }}</p>
                            <p>{{ $deposit->trip?->route_1 }}</p>
                            <p>{{ $deposit->trip?->route_2 }}</p>

                            <div class="block">&nbsp;</div>

                            <p>BBM</p>
                            <div class="block">&nbsp;</div>
                            <p>MAKAN</p>
                            <div class="block">&nbsp;</div>
                            <p>CUCI MOBIL</p>
                            <div class="block">&nbsp;</div>
                            <p>KARCIS BANDARA</p>
                            <div class="block">&nbsp;</div>
                            <p class=" bg-slate-200">Bengkel</p>
                            <div class="block">&nbsp;</div>
                            <p>POM</p>
                            <div class="block">&nbsp;</div>
                            {{-- <p>POM</p>
                            <div class="block">&nbsp;</div> --}}
                            <p class=" font-bold text-end">{{ $deposit->trip?->driver?->name }}</p>
                            <P class=" font-bold text-end">Borneo</P>
                        </div>

                        {{-- KANAN (ANGKA) --}}
                        <div class="flex flex-col  w-fit text-end">
                            <div class="block">&nbsp;</div>
                            <p>{{ $fmt($deposit->trip?->departure_total) }}</p>
                            <p>{{ $fmt($deposit->trip?->return_total) }}</p>

                            <div class="block">&nbsp;</div>

                            <p class=" bg-orange-200">{{ $fmt($deposit->trip?->cost?->bbm_total) }}</p>
                            <div class="block">&nbsp;</div>

                            <p>{{ $fmt($deposit->trip?->cost?->makan_total) }}</p>
                            <div class="block">&nbsp;</div>

                            <p>{{ $fmt($deposit->trip?->cost?->wash_total) }}</p>
                            <div class="block">&nbsp;</div>

                            <p>{{ $fmt($deposit->trip?->cost?->parking_total) }}</p>
                            <div class="block">&nbsp;</div>

                            <p>{{ $fmt($deposit->trip?->cost?->repair_total) }}</p>
                            <div class="block">&nbsp;</div>

                            <p>{{ $fmt($deposit->trip?->cost?->pom_total) }}</p>
                            <div class="block">&nbsp;</div>


                            <p class=" text-end">{{ $deposit->trip?->driver->persentase_hasil }}</p>
                            <p class=" text-end">{{ 100 - $deposit->trip?->driver->persentase_hasil }}</p>
                            <p class=" font-bold">Koperasi</p>
                            <div class="block">&nbsp;</div>
                            <p class=" bg-slate-200">Bengkel</p>
                            <div class="block">&nbsp;</div>
                            <p class=" bg-orange-200">FEE</p>
                            {{-- <p>{{ $fmt(0) }}</p> --}}
                        </div>

                        {{-- KOLOM SISA --}}
                        <div class="flex flex-col  w-72 text-end">
                            <div class="block">&nbsp;</div>
                            <div class="block">&nbsp;</div>

                            <p class=" bg-orange-200">FEE</p>
                            <p>{{ $fmt($tripTotal - $fee) }}</p>

                            <div class="block">&nbsp;</div>
                            <p>{{ $fmt($sisa1) }}</p>

                            <div class="block">&nbsp;</div>
                            <p>{{ $fmt($sisa2) }}</p>

                            <div class="block">&nbsp;</div>
                            <p>{{ $fmt($sisa3) }}</p>

                            <div class="block">&nbsp;</div>
                            <p>{{ $fmt($sisa4) }}</p>

                            <div class="block">&nbsp;</div>
                            <p>{{ $fmt($sisa5) }}</p>

                            <div class="block">&nbsp;</div>
                            <p>{{ $fmt($sisa6) }}</p>
                            @php
                                $totalDeposit = $deposit->total_deposit ?? 0;

                                $persen = $deposit->trip?->driver?->persentase_hasil ?? 0; // contoh: 60
                                $persenDriver = $persen / 100;
                                $persenCompany = (100 - $persen) / 100;

                                $totalDriver = $sisa6 * $persenDriver;
                                $totalCompany = $sisa6 * $persenCompany;

                                $koperasi = $deposit->trip?->driver?->tanggungan_koperasi ?? 0;

                                $companyPlusKoperasi = $koperasi + $totalCompany;
                                $companyPlusKoperasiPlusBengkel =
                                    $companyPlusKoperasi + $deposit->trip?->cost?->repair_total;
                                $final = $companyPlusKoperasiPlusBengkel + $deposit->trip?->fee_total;
                            @endphp


                            <p>{{ $fmt($totalDriver) }}</p>
                            <p>{{ $fmt($totalCompany) }}</p>
                            <p>{{ $fmt($koperasi) }}</p>
                            <p>{{ $fmt($companyPlusKoperasi) }}</p>
                            <p class=" bg-slate-200">{{ $fmt($deposit->trip?->cost?->repair_total) }}</p>
                            <p>{{ $fmt($companyPlusKoperasiPlusBengkel) }}</p>
                            <p class=" bg-orange-200">{{ $fmt($deposit->trip?->fee_total) }}</p>
                            <p>{{ $fmt($final) }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mb-6 mt-6">
                        <h1 class="text-2xl font-bold">Pembayaran</h1>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
