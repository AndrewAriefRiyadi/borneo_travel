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

        $sisa1 = $tripTotal  - $bbm;
        $sisa2 = $sisa1 - $makan;
        $sisa3 = $sisa2 - $wash;
        $sisa4 = $sisa3 - $parking;
        $sisa5 = $sisa4 - $repair;
        $sisa6 = $sisa5 - $pom;
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Header --}}
                    <div class="flex items-center mb-6 gap-4">
                        <a href="{{ route('trip.edit', $deposit->trip?->id) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-100 text-gray-700 text-sm font-semibold
               hover:bg-gray-200 hover:text-gray-900 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                            Back
                        </a>
                        <h1 class="text-2xl font-bold">Deposit</h1>
                    </div>


                    <div class="flex w-full justify-center border ">
                        {{-- KIRI --}}
                        <div class="flex flex-col mr-1  w-fit text-end">
                            <p class="text-start">Tanggal</p>
                            <p>{{ $deposit->trip?->departure_date }}</p>
                            <p>{{ $deposit->trip?->return_date }}</p>


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
                            <p class=" bg-slate-200">Biaya Service</p>
                            <div class="block">&nbsp;</div>
                            <p>Jasa BBM</p>
                            <div class="block">&nbsp;</div>
                            {{-- <p>POM</p>
                            <div class="block">&nbsp;</div> --}}
                            <p class=" font-bold text-end">{{ $deposit->trip?->driver?->user->name }}</p>
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


                            <p class=" text-end">{{ $deposit->trip?->driver->persentase_hasil }}%</p>
                            <p class=" text-end">{{ 100 - $deposit->trip?->driver->persentase_hasil }}%</p>
                            <p class=" font-bold">Koperasi</p>
                            <div class="block">&nbsp;</div>
                            <p class=" bg-slate-200">Biaya Service</p>
                            <div class="block">&nbsp;</div>
                            <p class=" bg-orange-200">FEE</p>
                            <p class=" font-bold">Total Setoran</p>
                            {{-- <p>{{ $fmt(0) }}</p> --}}
                        </div>

                        {{-- KOLOM SISA --}}
                        <div class="flex flex-col  w-72 text-end">
                            <div class="block">&nbsp;</div>
                            <div class="block">&nbsp;</div>
                            <div class="block">&nbsp;</div>

                            <p>{{ $fmt($tripTotal) }}</p>

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

                                $koperasi = $deposit->total_koperasi ?? 0;

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
                            <p class=" font-bold">{{ $fmt($final) }}</p>
                        </div>
                    </div>

                    @php
                        // mode bisa dari query string: ?mode=view atau ?mode=form
                        $mode = request('mode', 'view'); // default view
                        $isView = $mode === 'view';

                        $payment = $deposit->payment; // bisa null

                        $status = $payment?->status ?? 'draft';

                        $paymentMethod = old('payment_method', $payment?->payment_method);
                    @endphp

                    <div class="py-12">
                        <div class="w-full ">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class=" text-gray-900">

                                    {{-- Header --}}
                                    <div class="flex items-center gap-6 mb-6">
                                        <h1 class="text-2xl font-bold">Pembayaran</h1>
                                    </div>

                                    {{-- STATUS BADGE --}}
                                    <div class="mb-6">
                                        {{-- Switch Mode Button --}}
                                        @if ($isView)
                                            @role('user')
                                                <a href="{{ route('deposit.payment', $deposit->id) }}?mode=form"
                                                    class="inline-flex items-center px-4 py-2 bg-blue-600 rounded-md text-sm font-semibold text-white hover:bg-blue-700 transition">
                                                    Input Pembayaran
                                                </a>
                                            @endrole
                                        @else
                                            <a href="{{ route('deposit.payment', $deposit->id) }}?mode=view"
                                                class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md text-sm font-semibold text-white hover:bg-gray-700 transition">
                                                Lihat Detail
                                            </a>
                                        @endif
                                        @if ($status === 'lunas')
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                                                Lunas
                                            </span>
                                        @elseif (!$payment)
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-200 text-gray-800">
                                                Belum Bayar
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700 border border-yellow-200">
                                                Belum Lunas
                                            </span>
                                        @endif
                                    </div>

                                    <form method="POST" action="{{ route('deposit.payment', $deposit->id) }}"
                                        enctype="multipart/form-data" class="space-y-6" x-data="{
                                            payment_method: '{{ old('payment_method', $payment?->payment_method) }}'
                                        }">

                                        @csrf

                                        <div class="border rounded-lg p-6 bg-gray-50 space-y-4">

                                            {{-- Payment Method --}}
                                            @if (!$isView)
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                                        Payment Method
                                                    </label>

                                                    <select name="payment_method" x-model="payment_method"
                                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                                        required>

                                                        <option value="">-- Choose Payment Method --</option>
                                                        <option value="cash">Cash</option>
                                                        <option value="transfer">Transfer</option>
                                                    </select>

                                                    @error('payment_method')
                                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            @endif


                                            {{-- Attachment Nota (selalu tampil) --}}
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                    Attachment Nota
                                                </label>

                                                @if ($isView)
                                                    @if ($payment?->attachment_nota)
                                                        <a href="{{ asset('storage/' . $payment->attachment_nota) }}"
                                                            target="_blank"
                                                            class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md text-sm font-semibold text-white hover:bg-gray-700 transition">
                                                            Lihat Nota
                                                        </a>
                                                    @else
                                                        <p class="text-sm text-gray-500">Tidak ada nota.</p>
                                                    @endif
                                                @else
                                                    <input type="file" name="attachment_nota" required
                                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                                                    @error('attachment_nota')
                                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                    @enderror
                                                @endif
                                            </div>

                                            {{-- Attachment Transfer (hanya muncul kalau transfer) --}}
                                            <div x-show="payment_method === 'transfer'" x-cloak>
                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                    Attachment Transfer
                                                </label>

                                                @if ($isView)
                                                    @if ($payment?->attachment_transfer)
                                                        <a href="{{ asset('storage/' . $payment->attachment_transfer) }}"
                                                            target="_blank"
                                                            class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md text-sm font-semibold text-white hover:bg-gray-700 transition">
                                                            Lihat Bukti Transfer
                                                        </a>
                                                    @else
                                                        <p class="text-sm text-gray-500">Tidak ada bukti transfer.</p>
                                                    @endif
                                                @else
                                                    <input type="file" name="attachment_transfer"
                                                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                                                    @error('attachment_transfer')
                                                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                                    @enderror
                                                @endif
                                            </div>

                                        </div>

                                        {{-- BUTTON SAVE (hanya muncul di form mode) --}}
                                        @if (!$isView)
                                            <div class="flex justify-end mt-4">
                                                <button type="submit"
                                                    class="inline-flex items-center px-6 py-2 bg-blue-600 rounded-md text-sm font-semibold text-white hover:bg-blue-700 transition">
                                                    Simpan Pembayaran
                                                </button>
                                            </div>
                                        @endif

                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
