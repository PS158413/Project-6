@section('content')
    @extends('layouts.app')

    <div class="max-w-7xl mx-3 md:mx-6 2xl:mx-auto">

        <div class="w-full text-center max-w-screen-lg mx-auto my-5">
            <h1 class="text-4xl font-bold text-Electric_Blue ">We horen graag van je</h1>
            <p class="font-semibold">Onze klantenservice helpt je met al je vragen</p>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center my-10 space-x-0 space-y-4 md:space-y-0 md:space-x-6">
            <div class="p-8 flex flex-col justify-between space-y-4 bg-lime-100 rounded-md"> 
                 <h1 class="text-2xl font-bold">Bekijk onze FAQ</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus quidem facilis maxime quisquam ullam ratione, suscipit iure ex totam id nulla incidunt error,</p>
                <a class="uppercase text-Electric_Blue shadow-md bg-LemonGreen px-2 py-1 w-1/2 text-center font-semibold rounded-sm hover:bg-lime-400" href="#">Bekijk de FAQ</a>
            </div>
            <div class="p-8 flex flex-col justify-between space-y-4 bg-lime-100 rounded-md"> 
                 <h1 class="text-2xl font-bold">Telefoon</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus quidem facilis maxime quisquam ullam ratione, suscipit iure ex totam id nulla incidunt error,</p>
                <a class="uppercase text-Electric_Blue shadow-md bg-LemonGreen px-2 py-1 w-1/2 text-center font-semibold rounded-sm hover:bg-lime-400" href="#">Bel 0612345789</a>
            </div>
            <div class="p-8 flex flex-col justify-between space-y-4 bg-lime-100 rounded-md"> 
                 <h1 class="text-2xl font-bold">E-mail</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus quidem facilis maxime quisquam ullam ratione, suscipit iure ex totam id nulla incidunt error,</p>
                <a class="uppercase text-Electric_Blue shadow-md bg-LemonGreen px-2 py-1 w-1/2 text-center font-semibold rounded-sm hover:bg-lime-400" href="#">Stuur een E-mail</a>
            </div>
            
        </div>

        <div class="flex flex-col space-y-8 w-full justify-center mb-10">
            {{-- form for contact --}}
            <div class="p-12 mx-auto rounded-md bg-LemonGreen text-Electric_Blue w-full">
                <form action="" method="">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="font-semibold text-lg">Uw naam</label>
                        <input type="text" name="name" id="name" placeholder="Naam"
                            class="bg-gray-100 w-full border-1 p-2 rounded-sm @error('name') border-red-500 @enderror"
                            value="{{ old('name') }}">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="font-semibold text-lg">E-mail</label>
                        <input type="text" name="email" id="email" placeholder="E-mail"
                            class="bg-gray-100 border-1 w-full p-2 rounded-sm @error('email') border-red-500 @enderror"
                            value="{{ old('email') }}">
                    </div>

                    <div class="mb-4">
                        <label for="message" class="font-semibold text-lg">Opmerking</label>
                        <textarea name="message" id="message" cols="30" rows="4"
                            class="bg-gray-100 border-1 w-full p-4 rounded-sm @error('message') border-red-500 @enderror" placeholder="Bericht">{{ old('message') }}</textarea>
                    </div>

                    <div class="text-center md:text-left">
                        <button type="submit"
                            class="bg-transparent text-Electric_Blue border border-Electric_Blue px-4 py-3 rounded font-medium w-full md:w-auto hover:bg-Electric_Blue hover:text-white">
                            Verzenden
                        </button>
                    </div>
                </form>
            </div>

            <iframe class="w-full h-[400px]"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63143.578008275355!2d5.407955074609753!3d51.4559023539057!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6dec7ef9af41d%3A0x7cf4b4c2eb5d9fc9!2sTorenberglaan%2029%2C%205628%20EL%20Eindhoven!5e0!3m2!1sen!2snl!4v1676637895624!5m2!1sen!2snl"
            width="" height="" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
@stop
