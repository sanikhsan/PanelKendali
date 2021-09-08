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
                    <a href="#" aria-label="current-page">Shopping Cart</a>
                </li>
            </ul>
        </div>
    </section>
    <!-- END: BREADCRUMB -->

    <!-- START: COMPLETE YOUR ROOM -->
    <section class="md:py-16">
        <div class="container mx-auto px-4">
            <div class="flex -mx-4 flex-wrap">
                <div class="w-full px-4 mb-4 md:w-8/12 md:mb-0" id="shopping-cart">
                    <div class="flex flex-start mb-4 mt-8 pb-3 border-b border-gray-200 md:border-b-0">
                        <h3 class="text-2xl">Shopping Cart</h3>
                    </div>

                    <div class="border-b border-gray-200 mb-4 hidden md:block">
                        <div class="flex flex-start items-center pb-2 -mx-4">
                            <div class="px-4 flex-none">
                                <div class="" style="width: 90px">
                                    <h6>Photo</h6>
                                </div>
                            </div>
                            <div class="px-4 w-5/12">
                                <div class="">
                                    <h6>Produk</h6>
                                </div>
                            </div>
                            <div class="px-4 w-5/12">
                                <div class="">
                                    <h6>Harga</h6>
                                </div>
                            </div>
                            {{-- <div class="px-4 w-3/12">
                                <div class="">
                                    <h6>Quantity</h6>
                                </div>
                            </div> --}}
                            <div class="px-4 w-2/12">
                                <div class="text-center">
                                    <h6>Action</h6>
                                </div>
                            </div>
                        </div>
                    </div>


                    @forelse ($carts as $item)
                        
                    <!-- START: ROW 1 -->
                    <div class="flex flex-start flex-wrap items-center mb-4 -mx-4" data-row="1">
                        <div class="px-4 flex-none">
                            <div class="" style="width: 90px; height: 90px">
                                <img src="{{ $item->product->galleries()->exists() ? $item->product->galleries->first()->url : 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==' }}" alt="chair-1"
                                    class="object-cover rounded-xl w-full h-full" />
                            </div>
                        </div>
                        <div class="px-4 w-auto flex-1 md:w-5/12">
                            <div class="">
                                <h6 class="font-semibold text-lg md:text-xl leading-8">
                                    {{ $item->product->name }}
                                </h6>
                                <span class="text-sm md:text-sm">{{ $item->product->category->name }}</span>
                                <h6 class="font-semibold text-base md:text-lg block md:hidden">
                                    IDR {{ number_format($item->product->price) }}
                                </h6>
                                {{-- <h6 class="font-semibold text-base md:text-lg block md:hidden w-8">
                                    <input data-input name="quantity" type="number" id="quantity"
                                    class="border-gray-200 border rounded-lg px-1 py-1 bg-white text-sm focus:border-blue-200 focus:outline-none text-center"
                                    value="1"
                                    placeholder="banyak jumlah" />
                                </h6> --}}
                            </div>
                        </div>
                        <div class="px-4 w-auto flex-none md:flex-1 md:w-5/12 hidden md:block">
                            <div class="">
                                <h6 class="font-semibold text-lg">IDR {{ number_format($item->product->price) }}</h6>
                            </div>
                        </div>
                        {{-- <div class="px-4 w-auto flex-none md:flex-1 md:w-3/12 hidden md:block">
                            <div class="">
                                <input data-input name="quantity" type="number" id="quantity"
                                    class="lg:ml-24 w-16 border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none text-center"
                                    value=1
                                    placeholder="banyak jumlah" />
                            </div>
                        </div> --}}
                        <div class="px-4 w-2/12">
                            {{-- <div class="text-center py-1">
                                <form action="{{ route('cart-delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                      </button>
                                </form>
                            </div> --}}
                            <div class="text-center">
                                <form action="{{ route('cart-delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                      </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- END: ROW 1 -->

                    @empty

                        <p id="cart-empty" class="text-center py-8">
                            Ooops... Kosong
                            <a href="{{ route('index') }}" class="underline">Belanja Sekarang</a>
                        </p>
                        
                    @endforelse

                </div>
                <div class="w-full md:px-4 md:w-4/12" id="shipping-detail">
                    <div class="bg-gray-100 px-4 py-6 md:p-8 md:rounded-3xl">
                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf
                            <div class="flex flex-start mb-6">
                                <h3 class="text-2xl">Informasi Pengiriman</h3>
                            </div>

                            <div class="flex flex-col mb-4">
                                <label for="complete-name" class="text-sm mb-2">Nama Lengkap</label>
                                <input data-input name="name" type="text" id="complete-name"
                                    class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
                                    value="{{ $user->name }}"
                                    placeholder="Masukan nama kamu" />
                            </div>

                            <div class="flex flex-col mb-4">
                                <label for="email" class="text-sm mb-2">Alamat Email</label>
                                <input data-input name="email" type="email" id="email"
                                    class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
                                    value="{{ $user->email }}"
                                    placeholder="masukan alamat email kamu" />
                            </div>

                            <div class="flex flex-col mb-4">
                                <label for="address" class="text-sm mb-2">Alamat Rumah</label>
                                <input data-input name="address" type="text" id="address"
                                    class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
                                    value="{{ $user->address }}"
                                    placeholder="masukan alamat rumah kamu" />
                            </div>

                            <div class="flex flex-col mb-4 hidden">
                                <label for="quantity" class="text-sm mb-2">Quantity</label>
                                <input data-input name="quantity" type="number" id="quantity"
                                    class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
                                    value="1"
                                    placeholder="banyak jumlah" />
                            </div>

                            <div class="flex flex-col mb-4">
                                <label for="phone-number" class="text-sm mb-2">Nomor Telepon</label>
                                <input data-input name="phone" type="tel" id="phone-number"
                                    class="border-gray-200 border rounded-lg px-4 py-2 bg-white text-sm focus:border-blue-200 focus:outline-none"
                                    value="{{ $user->phone }}"
                                    placeholder="masukan nomor telepon kamu" />
                            </div>

                            {{-- <div class="flex flex-col mb-4">
                                <label for="complete-name" class="text-sm mb-2">Choose Courier</label>
                                <div class="flex -mx-2 flex-wrap">
                                    <div class="px-2 w-6/12 h-24 mb-4">
                                        <button type="button" data-value="fedex" data-name="courier"
                                            class="border border-gray-200 focus:border-red-200 flex items-center justify-center rounded-xl bg-white w-full h-full focus:outline-none">
                                            <img src="/frontend/images/content/logo-jnt.svg" alt="Logo Fedex"
                                                class="object-contain max-h-full" />
                                        </button>
                                    </div>
                                    <div class="px-2 w-6/12 h-24 mb-4">
                                        <button type="button" data-value="dhl" data-name="courier"
                                            class="border border-gray-200 focus:border-red-200 flex items-center justify-center rounded-xl bg-white w-full h-full focus:outline-none">
                                            <img src="/frontend/images/content/logo-sicepat.svg" alt="Logo dhl"
                                                class="object-contain max-h-full" />
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col mb-4">
                                <label for="complete-name" class="text-sm mb-2">Choose Payment</label>
                                <div class="flex -mx-2 flex-wrap">
                                    <div class="px-2 w-6/12 h-24 mb-4">
                                        <button type="button" data-value="midtrans" data-name="payment"
                                            class="border border-gray-200 focus:border-red-200 flex items-center justify-center rounded-xl bg-white w-full h-full focus:outline-none">
                                            <img src="/frontend/images/content/logo-midtrans.png" alt="Logo midtrans"
                                                class="object-contain max-h-full" />
                                        </button>
                                    </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="text-center">
                                <button type="submit"
                                    style="background-color:#FFCA99; color:black !important"
                                    class="text-black focus:outline-none w-full py-3 rounded-full text-lg px-6">
                                    Buat Pesanan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: COMPLETE YOUR ROOM -->

@endsection