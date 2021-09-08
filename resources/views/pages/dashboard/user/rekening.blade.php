<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Transaksi &raquo; Upload Bukti Transaksi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                            There's something wrong!
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>
                    </div>
                @endif

                <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class=" py-4 px-4" >
                        <div class=" ">
                            <div class="bg-white relative shadow p-2 rounded-lg text-gray-800 hover:shadow-lg">
                                <img src="https://rec-data.kalibrr.com/logos/TEGVPZGQFAY93GA5FRUU4V3K35TWQZ2GXLYQPAUT-5c63e5a5.jpg" class="h-32 rounded-lg w-full object-cover">
                                <div class="py-2 px-2">
                                    <div class=" font-bold font-title text-center">Bank Permata</div>
    
                                    <div class="text-sm font-light text-center my-2">0000000000 - A/N Admin Admod</div>
                                </div>
                            </div>
                        </div>
                    </div>	
        
                    <div class=" py-4 px-4" >
                        <div class=" ">
                            <div class="bg-white relative shadow p-2 rounded-lg text-gray-800 hover:shadow-lg">
                                <img src="https://rec-data.kalibrr.com/logos/TEGVPZGQFAY93GA5FRUU4V3K35TWQZ2GXLYQPAUT-5c63e5a5.jpg" class="h-32 rounded-lg w-full object-cover">
                                <div class="py-2 px-2">
                                    <div class=" font-bold font-title text-center">Bank Permata</div>
    
                                    <div class="text-sm font-light text-center my-2">0000000000 - A/N Admin Admod</div>
                                </div>
                            </div>
                        </div>
                    </div>	
        
        
                    <div class=" py-4 px-4" >
                        <div class=" ">
                            <div class="bg-white relative shadow p-2 rounded-lg text-gray-800 hover:shadow-lg">
                                <img src="https://rec-data.kalibrr.com/logos/TEGVPZGQFAY93GA5FRUU4V3K35TWQZ2GXLYQPAUT-5c63e5a5.jpg" class="h-32 rounded-lg w-full object-cover">
                                <div class="py-2 px-2">
                                    <div class=" font-bold font-title text-center">Bank Permata</div>
    
                                    <div class="text-sm font-light text-center my-2">0000000000 - A/N Admin Admod</div>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>

                <div class="container pt-5">
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 py-3 text-center">
                            <a href="https://api.whatsapp.com/send/?phone=628996372182&text=Halo+Admin+Saya+ingin+memverifikasi+pesanan+saya,+berikut+ini+bukti+transfernya&app_absent=0"
                               target="_blank"
                               class=" shadow-lg bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Kirim Bukti Transfer
                            </a>
                        </div>
                        <div class="w-full px-3 py-3 text-right">
                            <a href="{{ route('dashboard.my-transaction.index') }}"
                               class=" shadow-lg bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
