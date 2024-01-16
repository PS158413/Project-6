@extends('layouts.app')
@section('content')
    <div class="flex mx-10">
        @if(session('cart'))
            <table id="cart" class="w-3/4 mx-auto text-sm text-left text-gray-500 dark:text-gray-400 my-10">
                <thead class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th>Product</th>
                    <th>Prijs</th>
                    <th class="pr-5">Aantal</th>
                    <th class="text-center">Subtotaal</th>
                    <th>Verwijder</th>
                </tr>
                </thead>
                <tbody>
                @php $total = 0 @endphp
                    @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <tr data-id="{{ $id }}" class="bg-white text-xl border-b dark:bg-gray-800 dark:border-gray-700">
                            <td data-th="Product">
                                <div class="row my-4">
                                    <div class="col-sm-3"><img src="{{ $details['image']}}" width="100" height="100" class="img-responsive rounded-md"/></div>
                                    <div class="col-sm-9">
                                        <h3 class="text-base mt-2">{{ $details['name'] }}</h3>
                                    </div>
                                </div>
                            </td>
                            <td data-th="Price text-center"> €{{ $details['price'] }}</td>
                            <td data-th="Quantity" class="text-center">
                                <label>
                                    <input type="number" readonly value="{{ $details['quantity'] }}" class="form-control quantity cart_update" min="1" />
                                </label>
                            </td>
                            <td data-th="Subtotal" class="text-center"> €{{ $details['price'] * $details['quantity'] }}</td>
                                <td class="actions text-center" data-th="">
                                    <form action="{{route('remove_from_cart', $id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="flex justify-center items-center"> <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="34px" height="34px"><path fill="#CD1818" d="M34,12l-6-6h-8l-6,6h-3v28c0,2.2,1.8,4,4,4h18c2.2,0,4-1.8,4-4V12H34z"/><path fill="#ffffff" d="M24.5 39h-1c-.8 0-1.5-.7-1.5-1.5v-19c0-.8.7-1.5 1.5-1.5h1c.8 0 1.5.7 1.5 1.5v19C26 38.3 25.3 39 24.5 39zM31.5 39L31.5 39c-.8 0-1.5-.7-1.5-1.5v-19c0-.8.7-1.5 1.5-1.5l0 0c.8 0 1.5.7 1.5 1.5v19C33 38.3 32.3 39 31.5 39zM16.5 39L16.5 39c-.8 0-1.5-.7-1.5-1.5v-19c0-.8.7-1.5 1.5-1.5l0 0c.8 0 1.5.7 1.5 1.5v19C18 38.3 17.3 39 16.5 39z"/><path fill="#CD1818" d="M11,8h26c1.1,0,2,0.9,2,2v2H9v-2C9,8.9,9.9,8,11,8z"/></svg></button>
                                    </form>
                                </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5" class="text-right text-xl"><h3><strong>Total  €{{ $total }}</strong></h3></td>
                </tr>
                <tr>
                    <td colspan="5" class="flex items-center space-x-6 text-xl font-semibold">
                        <a href="{{ url('/products') }}" class="btn btn-danger hover:text-gray-900"> <i class="fa fa-arrow-left"></i> Verder shoppen</a>
                    </td>
                </tr>
                </tfoot>
            </table>
        @else
            <div class="w-full flex flex-col space-y-6 items-center justify-center my-10">
                <h1 class="text-2xl font-semibold">Geen artikelen in winkelwagen</h1>
                <a href="{{ url('/products') }}" class="btn btn-danger hover:text-gray-900"> <i class="fa fa-arrow-left"></i> Verder shoppen</a>
            </div>
        @endif
        @if(session('cart'))
        <div class="w-1 bg-Electric_Blue my-10 mx-4 pointer-events-none opacity-5"></div>
            <div id="cart" class="w-1/4 mx-4 text-sm text-left text-gray-500 dark:text-gray-400 my-10">
                <div class="text-xl text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <div>
                        <div  class="bg-white text-xl border-b dark:bg-gray-800 dark:border-gray-700">
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <h3 class="text-2xl font-bold text-Electric_Blue">Vul je gegevens in</h3>
                                    </div>
{{--                                    {{dd(session('SESSION_USER_DATA'))}}--}}
                                    <form class="flex flex-col space-y-4" method="POST" action="{{route('cart.checkout')}}">

                                        @csrf
                                                <!-- Name -->
                                                <div>
                                                    <x-input-label for="name" :value="__('Naam')" />
                                                    <x-text-input id="name" class="block mt-1 w-full border border-gray-300" type="text" name="name" :value="old('name',  session('SESSION_USER')  ?? '')" required autofocus autocomplete="name" />
                                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                </div>

                                                <!-- Email Address -->
                                                <div class="mt-4">
                                                    <x-input-label for="email" :value="__('E-mail')" />
                                                    <x-text-input id="email" class="block mt-1 w-full p-1 border border-gray-300" type="email" name="email" :value="old('email', auth()->user()->email ?? '')" required autocomplete="username" />
                                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="phone" :value="__('Telefoonnummer')" />
                                                    <div class="flex">
                                                        <div class="flex-1">
                                                            <x-text-input id="phone" class="block mt-1 w-full p-1 border border-gray-300" type="text" name="phone" :value="old('phone', auth()->user()->phone ?? '')" required autofocus />
                                                        </div>
                                                    </div>
                                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="zipcode" :value="__('Postcode')" />
                                                    <x-text-input id="zipcode" class="block mt-1 w-full p-1 border border-gray-300" type="text" name="zipcode" :value="old('postcode', auth()->user()->postcode ?? '')" required autofocus autocomplete="postcode" />
                                                    <x-input-error :messages="$errors->get('postcode')" class="mt-2" />
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="huisnummer" :value="__('Huisnummer')" />
                                                    <x-text-input id="huisnummer-input" class="block mt-1 w-full p-1 border border-gray-300" type="text" name="huisnummer" :value="old('huisnummer', auth()->user()->housenumebr ?? '')" required autofocus autocomplete="huisnummer" />
                                                    <x-input-error :messages="$errors->get('huisnummer')" class="mt-2" />
                                                </div>

                                                <div class="mt-4">
                                                    <x-input-label for="address" :value="__('Adres')" />
                                                    <x-text-input id="address" class="block mt-1 w-full p-1 border border-gray-300" type="text" name="address" :value="old('straat')" required autofocus />
                                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                                </div>

                                                <div class="mt-4" >
                                                    <x-input-label for="city" :value="__('Stad')" />
                                                    <x-text-input id="city" class="block mt-1 w-full p-1 border border-gray-300" type="text" name="city" autofocus />
                                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                                </div>
                                                @foreach(session('cart') as $id => $details)
                                                        <input type="hidden" value=" {{ $id }} ">
                                                @endforeach
                                                <button class="bg-Electric_Blue text-gray-50 px-4 py-2 text-xl font-semibold rounded-md hover:bg-lime-400" type="submit">Afrekenen</button>
                                    </form>
                                </div>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
            @endif
    </div>
@endsection

