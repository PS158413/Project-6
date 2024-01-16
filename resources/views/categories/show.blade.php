@extends('layouts.app')

@section('content')
<div class="flex justify-center my-10">
    <form action="{{ route('category.update', $category['id']) }}" method="POST" class="w-1/2">
        @csrf
        @method('PUT')
        <h1 class="mb-4 text-2xl font-bold">Category Name:</h1>
        <input type="text" name="category" value="{{ $category['category'] }}" required class="border border-gray-300 rounded-md px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 mt-4">Update</button>
    </form>
</div>

<div class="flex">
    <div class="w-1/2">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Product</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category['products'] as $product)
                <tr>
                    <td class="px-4 py-2">{{ $product['name'] }}</td>
                    <td class="px-4 py-2">
                        <form action="{{ route('product.detach', $category['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="name" value="{{ $product['name'] }}">
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="w-1/2">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Product</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($filteredProducts as $product)
                <tr>
                    <td class="px-4 py-2">{{ $product['name'] }}</td>
                    <td class="px-4 py-2">
                        <form action="{{ route('category.store', $category['id']) }}" method="POST">
                            @csrf
                            <input type="hidden" name="category" value="{{ $category['category'] }}">
                            <input type="hidden" name="name" value="{{ $product['name'] }}">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-500">Add</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
