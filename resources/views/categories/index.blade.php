@section('content')
    @extends('layouts.app')

    <body>
    <h1 class="text-xl md:text-4xl font-bold text-center my-10">Categories</h1>

    {{-- if page is loading show loading --}}
    @if (!$categories)
        <div class="flex justify-center items-center h-screen">
            <div class="animate-spin rounded-full h-32 w-32 border-b-2 border-gray-900"></div>
        </div>
    @endif
    <table class="w-full max-w-[80%] mx-auto bg-gray-50 my-10 shadow-md">
        <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr class="bg-gray-50">
            <th class="text-xl">Categorie tabel</th>
            <th></th>
            <th></th>
            <th>
                <a href="{{ route('category.create') }}">
                    <button class="bg-blue-500 text-white py-1 px-4 rounded-md my-4 uppercase">Categorie toevoegen</button>
                </a>
            </th>
        </tr>
        <tr class="bg-gray-200">
            <th>Id</th>
            <th class="p-3">Categorie</th>
            <th></th>
            <th>Actie</th>
        </tr>
        </thead>
        <tbody class="text-center">
        @foreach ($categories as $category)
            <tr class="font-semibold">
                <td class="p-3">{{ $category['id'] }}</td>
                <td> <h1 class="">{{ $category['category'] }}</h1></td>
                <td></td>
                <td class="pt-3 flex space-x-4 justify-center">
                    <a href="{{ route('category.show', $category['id']) }}">
                        <button class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Wijzigen</button>
                    </a>
                    <form method="POST" action="{{ route('category.destroy', $category['id']) }}">
                        @csrf
                        @method('DELETE')
                        <button class="font-medium text-red-600 dark:text-red-500 hover:underline" type="submit" onclick="return confirm('Are you sure you want to delete this category?')">Verwijdren</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </body>
@stop
