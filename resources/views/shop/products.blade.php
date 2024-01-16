@section('content')
    @extends('layouts.app')

    {{-- if page is loading show loading --}}
    @if (!$products)
        <div class="flex justify-center items-center h-screen">
            <div class="animate-spin rounded-full h-32 w-32 border-b-2 border-gray-900"></div>
        </div>
    @endif



    <!-- UI card from https://uxplanet.org/ultimate-guide-for-designing-ui-cards-59488a91b44f -->
    <div class="min-h-screen flex flex-col justify-center">
        <div class="relative m-3 flex flex-wrap mx-auto justify-center">
            @if ($products)
                @foreach ($products as $product)
                    <div
                        class="relative max-w-sm min-w-[400px] bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">
                        {{-- show product --}}
                        <div class="absolute z-10 top-2 right-2">
                            <form action="{{ route('add_to_cart') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $product['id'] }}" name="id">
                                <input type="hidden" value="{{ $product['name'] }}" name="name">
                                <input type="hidden" value="{{ $product['price'] }}" name="price">
                                <input type="hidden" value="{{ $product['image'] }}" name="image">
                                <input type="hidden" value="1" name="quantity" id="quantityInputValue">
                                <button type="submit"
                                        class="absolute right-2 top-2 bg-white rounded-full p-2 cursor-pointer group">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-6 w-6 group-hover:opacity-50 opacity-70" fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="black">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <a href="{{ route('show.product', $product['id']) }}">
                            {{-- show image --}}
                            <div class="overflow-x-hidden rounded-2xl relative">
                                <img class="h-60 rounded-2xl w-full object-cover" src="{{ $product['image'] }}">

                            </div>
                            <div class="mt-4 pl-2 mb-2 flex justify-between ">
                                <div>
                                    <p class="text-lg font-bold text-gray-900 mb-0">{{ $product['name'] }}</p>
                                    <p class="text-md text-gray-800 mt-0 font-semibold">€{{ $product['price'] }}</p>
                                </div>

                            </div>
                        </a>
                    </div>
                @endforeach
            @else
                <p>Geen producten gevonden.</p>
            @endif
        </div>
    </div>
    <div class="flex justify-between lg:mx-28 mx-5 border-t-2 border-Electric_Blue border-dashed items-center mt-4">
        <div class="flex justify-center my-6">
            <form id="previous-page-form" action="{{ route('product.index', ['page' => $page - 1]) }}" method="get">
                @csrf
                <button class="border-Electric_Blue bg-LemonGreen px-4 py-2 rounded-md text-Electric_Blue font-semibold" type="submit">Vorige</button>
            </form>
        </div>
        <div class="flex justify-center items-center my-6">
            <p class="px-2 py-1 bg-LemonGreen rounded-md font-bold">{{ $currentpage }}</p>
        </div>
        <div class="flex justify-center my-6">
            <form id="next-page-form" action="{{ route('product.index', ['page' => $page + 1]) }}" method="get">
                @csrf
                <button class="border-Electric_Blue bg-LemonGreen px-4 py-2 rounded-md text-Electric_Blue font-semibold" type="submit">Volgende</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('next-page-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission behavior

            var form = event.target; // Get the form element
            var url = form.getAttribute('action'); // Get the form action URL

            window.location.href = url; // Redirect to the next page URL
        });

        document.getElementById('previous-page-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission behavior

            var form = event.target; // Get the form element
            var url = form.getAttribute('action'); // Get the form action URL

            window.location.href = url; // Redirect to the next page URL
        });
    </script>

@stop
