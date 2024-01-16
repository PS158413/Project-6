@extends('layouts.app')
@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @elseif (session('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if ($product)
{{--        {{dd($product)}}--}}
    <section class="pt-12 pb-24 bg-blueGray-100 rounded-b-10xl overflow-hidden">

        <div class="container px-4 mx-auto">
            <div class="flex lg:flex-row flex-col lg:space-x-16 mx-auto">
                <div class="w-full lg:w-1/2 px-4 mb-16 lg:mb-0">
                    <div class="flex -mx-4 flex-wrap items-center justify-between lg:justify-start lg:items-start xl:items-center">
                        <div class="w-full sm:w-auto min-w-max text-center flex sm:flex-col items-center justify-center">
                            <img class="rounded-2xl h-full w-80 lg:w-full object-cover" src="{{ $product['image'] }}">
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 px-4">
                    <div class="max-w-md mb-6">
{{--                        TODO: get the category product belong to--}}
                        <span class="text-xs text-gray-400 tracking-wider"></span>
                        <h2 class="mt-6 mb-4 text-base md:text-xl lg:text-3xl font-heading font-medium"> {{ $product['name'] }}</h2>
                        <p class="flex items-center mb-6">
                            <span class="mr-2 text-sm text-Electric_Blue font-medium">€</span>
                            <span class="text-3xl text-Electric_Blue font-medium">{{$product['price']}}</span>
                        </p>
                        <p class="text-lg text-gray-400">{{$product['description']}}</p>
                    </div>


                    <div class="mb-10">
                        <h4 class="mb-3 font-heading font-medium">Aantal:</h4>
                        <div class="flex space-x-4">

                            <button id="decreaseBtn">
                                    <?xml version="1.0" encoding="utf-8"?>
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="22.881px" height="9.737px" viewBox="0 0 122.881 9.737" enable-background="new 0 0 122.881 9.737" xml:space="preserve">
                                    <g><path d="M117.922,0.006C117.951,0.002,117.982,0,118.012,0c0.656,0,1.285,0.132,1.861,0.371c0.014,0.005,0.025,0.011,0.037,0.017 c0.584,0.248,1.107,0.603,1.543,1.039c0.881,0.88,1.428,2.098,1.428,3.441c0,0.654-0.133,1.283-0.371,1.859 c-0.248,0.6-0.609,1.137-1.057,1.583c-0.445,0.445-0.98,0.806-1.58,1.055v0.001c-0.576,0.238-1.205,0.37-1.861,0.37 c-0.029,0-0.061-0.002-0.09-0.006c-37.654,0-75.309,0.001-112.964,0.001c-0.029,0.004-0.059,0.006-0.09,0.006 c-0.654,0-1.283-0.132-1.859-0.371c-0.6-0.248-1.137-0.609-1.583-1.056C0.981,7.865,0.621,7.33,0.372,6.73H0.371 C0.132,6.154,0,5.525,0,4.869C0,4.215,0.132,3.586,0.371,3.01c0.249-0.6,0.61-1.137,1.056-1.583 c0.881-0.881,2.098-1.426,3.442-1.426c0.031,0,0.061,0.002,0.09,0.006C42.613,0.006,80.268,0.006,117.922,0.006L117.922,0.006z"/></g>
                                </svg>
                            </button>
                            <input id="quantityInput" readonly class="w-24 px-3 py-2 text-center bg-white border-2 border-blue-500 outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 rounded-xl" value="1" type="number" min="1">
                            <button id="increaseBtn">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="22.881px" height="22px" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" id="plus-outline">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                    </div>

                        <form action="{{ route('add_to_cart') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $product['id'] }}" name="id">
                            <input type="hidden" value="{{ $product['name'] }}" name="name">
                            <input type="hidden" value="{{ $product['price'] }}" name="price">
                            <input type="hidden" value="{{ $product['image'] }}"  name="image">
                            <input type="hidden" value="" name="quantity" id="quantityInputValue">
                                <button class="block w-auto py-4 px-8 leading-8 font-heading font-medium tracking-tighter text-xl text-white text-center bg-Electric_Blue focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 hover:bg-blue-600 rounded-xl" type="submit" role="button">In winkelwagen</button>
                        </form>
{{--                        <div class="w-full md:w-2/3 px-2 mb-2 md:mb-0"><a class="block py-4 px-2 leading-8 font-heading font-medium tracking-tighter text-xl text-white text-center bg-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 hover:bg-blue-600 rounded-xl" href="{{}}">In winkelwagen</a></div>--}}
{{--                        TODO: make add to wishlist--}}
{{--                        <div class="w-full md:w-1/3 px-2">--}}
{{--                            <a class="flex w-full py-4 px-2 items-center justify-center leading-8 font-heading font-medium tracking-tighter text-xl text-center bg-white focus:ring-2 focus:ring-gray-200 focus:ring-opacity-50 hover:bg-opacity-60 rounded-xl" href="#">--}}
{{--                                <span class="mr-2">Wishlist</span>--}}
{{--                                <svg width="23" height="22" viewbox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <path d="M11.3235 20.1324L2.52488 10.8515C1.75232 10.0706 1.24237 9.06367 1.06728 7.97339C0.8922 6.88311 1.06086 5.76477 1.54936 4.7768V4.7768C1.91837 4.03089 2.45739 3.3843 3.12201 2.89033C3.78663 2.39635 4.55781 2.06911 5.37203 1.93558C6.18626 1.80205 7.0202 1.86605 7.80517 2.1223C8.59013 2.37855 9.30364 2.81972 9.88691 3.40946L11.3235 4.86204L12.7601 3.40946C13.3434 2.81972 14.0569 2.37855 14.8419 2.1223C15.6269 1.86605 16.4608 1.80205 17.275 1.93558C18.0892 2.06911 18.8604 2.39635 19.525 2.89033C20.1897 3.3843 20.7287 4.03089 21.0977 4.7768V4.7768C21.5862 5.76477 21.7549 6.88311 21.5798 7.97339C21.4047 9.06367 20.8947 10.0706 20.1222 10.8515L11.3235 20.1324Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>--}}
{{--                                </svg>--}}
{{--                            </a>--}}
{{--                        </div>--}}

                    <div>
                        <h4 class="mb-6 font-heading font-medium mt-4">Meer info</h4>
                        <button class="flex w-full pl-6 lg:pl-12 pr-6 py-4 mb-4 justify-between items-center leading-7 rounded-2xl border-2 border-blueGray-200 hover:border-blueGray-300">
                            <h3 class="text-lg font-heading font-medium">Shipping &amp; returns</h3>
                            <span>
                              <svg width="12" height="8" viewbox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.4594 0.289848C10.8128 -0.096616 11.3841 -0.096616 11.7349 0.289848C12.0871 0.676312 12.0897 1.30071 11.7349 1.68718L6.63794 7.21015C6.28579 7.59662 5.71584 7.59662 5.36108 7.21015L0.264109 1.68718C-0.0880363 1.30215 -0.0880363 0.676312 0.264109 0.289848C0.617558 -0.096616 1.18882 -0.096616 1.53966 0.289848L6.00147 4.81927L10.4594 0.289848Z" fill="black"></path>
                              </svg>
                            </span>
                        </button>
                        <div x-data="{ expanded: false }">
                            <button @click="expanded = ! expanded" class="flex w-full pl-6 lg:pl-12 pr-6 py-4 justify-between items-center leading-7 rounded-2xl border-2 border-blueGray-200 hover:border-blueGray-300">
                                <h3 class="text-lg font-heading font-medium">Product details</h3>
                                <span x-show="!expanded">
                                  <svg width="12" height="8" viewbox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.4594 0.289848C10.8128 -0.096616 11.3841 -0.096616 11.7349 0.289848C12.0871 0.676312 12.0897 1.30071 11.7349 1.68718L6.63794 7.21015C6.28579 7.59662 5.71584 7.59662 5.36108 7.21015L0.264109 1.68718C-0.0880363 1.30215 -0.0880363 0.676312 0.264109 0.289848C0.617558 -0.096616 1.18882 -0.096616 1.53966 0.289848L6.00147 4.81927L10.4594 0.289848Z" fill="black"></path>
                                  </svg>
                                </span>
                                <span x-show="expanded" style="transform: rotate(180deg);">
                                  <svg width="12" height="8" viewbox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.4594 0.289848C10.8128 -0.096616 11.3841 -0.096616 11.7349 0.289848C12.0871 0.676312 12.0897 1.30071 11.7349 1.68718L6.63794 7.21015C6.28579 7.59662 5.71584 7.59662 5.36108 7.21015L0.264109 1.68718C-0.0880363 1.30215 -0.0880363 0.676312 0.264109 0.289848C0.617558 -0.096616 1.18882 -0.096616 1.53966 0.289848L6.00147 4.81927L10.4594 0.289848Z" fill="black"></path>
                                  </svg>
                                </span>
                               </button>
                            <div x-show="expanded" x-collapse.duration.1000ms>
                                <ul class="px-6 mt-4 flex flex-col space-y-2 list-disc">
{{-- add sku, barcode and qr-code of product --}}
                                    <li class="font-semibold">
                                        <span class="text-base">SKU:</span>
                                        <span>{{$product['sku']}}</span>
                                    </li>
                                    <li class="font-semibold">
                                        <span class="text-base">Barcode:</span>
                                        <img src="data:image/png;base64,{{DNS1D::getBarcodePNG($product['barcode'], 'C39')}}" alt="barcode" />

                                    </li>
                                    <li class="font-semibold">
                                        <span class="text-base">QR-code:</span>
                                        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($product['barcode'], 'QRCODE')}}" alt="barcode" />
                                    </li>

                                    <li class="font-semibold">
                                        <span class="text-base">Hoogte:</span>
                                        <span>{{$product['height_cm']}} cm</span>
                                    </li>
                                    <li class="font-semibold">
                                        <span class="text-base">Breedte:</span>
                                        <span>{{$product['width_cm']}} cm</span>
                                    </li>
                                    <li class="font-semibold">
                                        <span class="text-base">Dipte:</span>
                                        <span>{{$product['depth_cm']}} cm</span>
                                    </li>
                                    <li class="font-semibold">
                                        <span class="text-base">Gewicht:</span>
                                        <span>{{$product['weight_gr']}} kg</span>
                                    </li>
                                </ul>

                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </section>
    @endif
@stop
