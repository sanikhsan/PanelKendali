@extends('layouts.frontend')

@section('content')

    <!-- START: BREADCRUMB -->
    <section class="bg-gray-100 py-8 px-4">
        <div class="container mx-auto">
            <ul class="breadcrumb">
                <li>
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li>
                    <a href="#" aria-label="current-page">Success Checkout</a>
                </li>
            </ul>
        </div>
    </section>
    <!-- END: BREADCRUMB -->

    <!-- START: CONGRATS -->
    <section class="">
        <div class="container mx-auto min-h-screen pt-24">
            <div class="flex flex-col items-center justify-center">
                <div class="w-full md:w-4/12 text-center">
                    <img src="/frontend/images/content/illustration-success.png" alt="congrats illustration" />
                    <h2 class="text-3xl font-semibold mb-6">Berhasil Membuat Pesanan!</h2>
                    <p class="text-lg mb-12">
                        Berhasil Membuat Pesanan, Silahkan selesaikan pembayaran anda dan upload bukti pembayaran.<br> Dan tunggu verifikasi oleh Admin
                    </p>
                    <a href="{{ route('dashboard.my-transaction.index') }}"
                        style="background-color:#FFCA99"
                        class="text-gray-900 bg-red-200 focus:outline-none w-full py-3 rounded-full text-lg focus:text-black transition-all duration-200 px-8 cursor-pointer">
                        Bayar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- END: CONGRATS -->

@endsection