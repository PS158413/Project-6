@extends('layouts.app')
@section('content')

    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>

    <!-- Jumbotron -->
    <div class="relative overflow-hidden bg-cover bg-no-repeat p-12 text-center h-[300px]"
         style="background-image: url('{{ asset('images/kaboompics.jpg') }}'); background-position: bottom;">
        <div class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-fixed"
             style="background-color: rgba(0, 0, 0, 0.6)">
            <div class="flex h-full items-center justify-center">
                <div class="text-Electric_Blue">
                    <h2 class="mb-4 text-xl font-semibold flex items-center bg-white/80 text-Electric_Blue pb-2.5 pt-0.5 px-2">
                        Welkom op Groene Vingers webshop!
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="italic text-Electric_Blue max-w-7xl 2xl:mx-auto w-full">
        <div class="mx-10 pt-5 flex flex-col md:flex-row mb-4 justify-between">
            <img class="rounded-md w-10/12 md:w-1/2 max-h-[200px] md:max-h-[400px] object-cover mx-auto md:mx-0"
                 src="{{ asset('images/flower-image.jpg') }}"/>
            <div class="pl-0 md:pl-10 pt-7 text-base md:text-xl mx-auto">
                <h1>Andere Vestigingen</h1>
                <div class="pt-3">
                    <ul class="list-disc">
                        <li>
                            <p>Abtstraat 30, 5504 CH Veldhoven</p>
                            <p>Telefoon: 06-852364718</p>
                        </li>
                    </ul>
                    <div class="pt-4">
                        <ul class="list-disc">
                            <li>
                                <p>Aarleseweg 31, 5684 LN Best</p>
                                <p>Telefoon: 06-134679842</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-base md:text-xl mx-auto">
            <div class="w-full text-center md:text-start ml-8">
                <h2>Tuinstraat 167</h2>
                <h2>2587 WD Nuenen</h2>
                <p>Telefoon: 06-33024999</p>
            </div>
        </div>
        <div class="pt-14 pl-48 pr-48 ">
            <div class="border-t-4 border-indigo-500 mb-5"></div>
        </div>
        <div>
            <h1 class="text-Electric_Blue text-base font-semibold flex justify-center lg:text-xl xl:text-2xl mt-5">Neem
                een kijkje</h1>
        </div>

        <form class="" id="filter-form" action="{{ route('home.index') }}" method="GET">
            <div class="btn-group flex flex-wrap space-x-4 space-y-2 justify-center mt-5">

                <button type="submit"
                        class="border border-Electric_Blue rounded-md p-1  mt-2 hover:text-white hover:bg-Electric_Blue hover:border-Electric_Blue {{ $selectedCategoryId == '' ? 'bg-Electric_Blue text-white border-Electric_Blue' : '' }}"
                        name="category" value="">Alles
                </button>
                    @foreach ($Homecategories as $category)
                        <button type="submit"
                                class="border border-Electric_Blue rounded-md p-1 hover:text-white hover:bg-Electric_Blue hover:border-Electric_Blue {{ $selectedCategoryId == $category['id'] ? 'bg-Electric_Blue text-white border-Electric_Blue' : '' }}"
                                name="category" value="{{ $category['id'] }}">
                            {{ $category['category'] }}
                        </button>
                    @endforeach

            </div>
        </form>
        <div class="slider flex justify-center items-center my-10 space-x-4 overflow-hidden">
            @if(isset($message))
                <p>{{ $message }}</p>
            @else
                @if($Homeproducts)
                    @foreach ($Homeproducts as $product)
                        <a href="{{ route('show.product', $product['id']) }}">
                            <div class="mx-2 my-4">
                                <div
                                    class="flex flex-col justify-between max-w-md shadow-md rounded-lg overflow-x-auto lg:overflow-hidden">
                                    <div class="h-40"
                                         style="background-image: url({{ $product['image'] }}); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                                    <div class="w-full p-4 flex flex-col h-52">
                                        <h1 class="text-gray-900 font-bold text-base w-full">{{ $product['name'] }}</h1>
                                        <p class="my-2 text-gray-600 text-sm truncate max-w-xs mb-auto h-full">{{ $product['description'] }}</p>
                                        <div class="flex flex-col item-center justify-between mt-3">
                                            <h1 class="text-gray-700 font-bold text-xl">€ {{ $product['price'] }}</h1>
                                            <button
                                                class="px-3 py-2 bg-Electric_Blue text-white text-xs font-bold uppercase rounded hover:bg-blue-600">
                                                Bekijk product
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>

                    @endforeach

                @else
                    <p>Geen producten gevonden</p>
                @endif

            @endif


        </div>
    </div>

    <script>
        document.getElementById('category').addEventListener('change', function () {
            document.getElementById('filter-form').submit();
        });
    </script>
@endsection
