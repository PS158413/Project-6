<ul id="navLinks" class="col-strat-0 md:col-start-4 col-span-0 mb-6 md:mb-0 md:col-span-6 flex-row items-center uppercase hidden font-bold text-base md:text-lg text-Electric_Blue text-center md:flex md:justify-center  lg:space-x-12 mt-10">
    <li class="py-2 px-4"><a href="/" class="hover:text-blue-600 hover:underline underline-offset-4  @if(Request::path() === '/')underline underline-offset-5 @endif">Home</a></li>
    <li class="py-2 px-4"><a href="/contact" class="hover:text-blue-600 hover:underline underline-offset-4 @if(Request::path() === 'contact')underline underline-offset-5 @endif">Contact</a></li>
    <li class="py-2 px-4"><a href="/products" class="hover:text-blue-600 hover:underline underline-offset-4 @if(Request::path() === 'products')underline underline-offset-5 @endif">Producten</a></li>
    <li class="py-2 px-4"><a href="/about" class="hover:text-blue-600 hover:underline underline-offset-4 @if(Request::path() === 'about')underline underline-offset-5 @endif">Over ons</a></li>
    <li>
        <a href="{{ route('cart') }}" class="flex items-center">
            <button type="button" class="flex items-center" data-toggle="dropdown">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> @if( count((array) session('cart')) >= 1 ) <span class="bg-Electric_Blue text-LemonGreen rounded-xl text-xs ml-1 py-1 px-2">{{ count((array) session('cart')) }}</span>@endif
            </button>
        </a>
    </li>

    <li class="px-auto py-2 static mx-auto md:absolute right-4 md:top-4">

        @if(session()->has('SESSION_API_BEARER_TOKEN'))
            <div class="flex flex-col space-y-2 justify-center items-center">
            {{-- Logout form --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="py-2 px-4 text-sm rounded-md bg-orange-800 text-white hover:bg-orange-600 uppercase">Uitloggen</button>
            </form>
            <a href="/profile" class="hover:text-blue-600 hover:underline underline-offset-4 pt-3 @if(Request::path() === 'profile')underline underline-offset-5 @endif"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#0752d5}</style><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg></a>
            </div>
        @else
            {{-- Login and Register buttons --}}
            <div class="max-w-[400px] flex space-x-6 justify-center mx-auto">
                <a href="/login" class="py-2 px-4 text-xs rounded-md bg-Electric_Blue text-white hover:bg-blue-600">login</a>
                <a href="/register" class="py-1.5 px-3 text-xs rounded-md bg-Electric_Blue text-white hover:bg-blue-600">Registreren</a>
            </div>
        @endif
    </li>
</ul>
