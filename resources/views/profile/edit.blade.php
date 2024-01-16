@extends('layouts.app')

@section('content')
    <!-- Update Profile Information Form -->
    <form action="{{ route('profile.update', $user['user']['id']) }}" method="POST" class="max-w-[900px] my-10 mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')
        <!-- Display the user data in the form inputs -->
        <div class="flex flex-wrap -mx-3 mb-4">
            <div class="w-full md:w-1/2 px-3 mb-4 md:mb-0">
                <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Naam</label>
                <input type="text" id="name" name="name" value="{{ $user['user']['name'] }}" required
                       class="appearance-none border border-gray-300 rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label for="last_name" class="block text-gray-700 text-sm font-semibold mb-2">Achternaam</label>
                <input type="text" id="last_name" name="last_name" value="{{ $user['user']['last_name'] }}" required
                       class="appearance-none border border-gray-300 rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-4">
            <div class="w-full md:w-1/2 px-3">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ $user['user']['email'] }}" required
                       class="appearance-none border border-gray-300 rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label for="city" class="block text-gray-700 text-sm font-semibold mb-2">Stad</label>
                <input type="text" id="city" name="city" value="{{ $user['user']['city'] }}" required
                       class="appearance-none border border-gray-300 rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>
        <div class="mb-6">
            <label for="phone" class="block text-gray-700 text-sm font-semibold mb-2">Telefoonnummer</label>
            <input type="text" id="phone" name="phone" value="{{ $user['user']['phone'] }}" required
                   class="appearance-none border border-gray-300 rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="mb-6">
            <label for="phone" class="block text-gray-700 text-sm font-semibold mb-2">Geboorte datum</label>
            <input type="date" id="birthday" name="birthday" value="{{ $user['user']['birthday'] }}" required
                   class="appearance-none border border-gray-300 rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="text-base mx-auto max-w-[500px] my-8 font-bold"><span class="text-red-800"> Let op!</span> Voer je wachtwoord in om de wijziging op te slaan</div>
        <div class="flex space-x-6">
               <label for="password">Wachtwoord:</label>
                <input type="password" name="password" id="password"
                       class="appearance-none border border-gray-300 rounded-md w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">


        <label for="password_confirmation">Bevestig wachtwoord:</label>
                 <input type="password" name="password_confirmation" id="password_confirmation"
                        class="appearance-none border border-gray-300 rounded-md w-full py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">

                <input type="role" name="role" value="" hidden>
        </div>

        <!-- Add more input fields for other user data -->
        <div class="text-center mt-5">
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                Wijzig
            </button>
        </div>
    </form>

@endsection
