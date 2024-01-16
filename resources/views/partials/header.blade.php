<div class="grid grid-cols-1 md:grid-cols-12 place-content-center bg-LemonGreen">
    <a href="/"><img src="{{ asset('images/logo-no-background.png') }}" class="max-w-[150px] -m-2 mx-auto col-start-1 col-span-2 p-5" alt="logo"></a>
    @if (session('SESSION_USER_ROLE') === 'superadmin')
        @include('partials\adminHeader')
    @elseif (session('SESSION_USER_ROLE') === 'user')
        @include('partials\usersHeader')
    @else
        <ul id="navLinks" class="col-strat-0 md:col-start-4 col-span-0 mb-6 md:mb-0 md:col-span-6 flex-row items-center uppercase hidden font-bold text-base md:text-lg text-Electric_Blue text-center md:flex md:justify-center lg:space-x-12">
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
                    {{-- Login and Register buttons --}}
                    <div class="max-w-[400px] flex space-x-6 justify-center mx-auto">
                        <a href="/login" class="py-2 px-4 text-xs rounded-md bg-Electric_Blue text-white hover:bg-blue-600">login</a>
                        <a href="/register" class="py-1.5 px-3 text-xs rounded-md bg-Electric_Blue text-white hover:bg-blue-600">Registreren</a>
                    </div>
            </li>
        </ul>
    @endif
    <div>
        {{-- hamburger menu --}}
        <div class="flex justify-end">
            <div id="hamburger" class="flex md:hidden absolute right-4">
                <button class="flex items-center px-3 py-2 border rounded text-blue-900 border-blue-900 hover:text-white hover:border-white">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

<script>
    const navLinks = document.getElementById("navLinks");
    const hamburgerButton = document.getElementById("hamburger");

    hamburgerButton.addEventListener("click", function() {
        navLinks.classList.toggle("hidden");
    });
</script>
</div>
