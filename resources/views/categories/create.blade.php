@extends('layouts.app')

@section('content')
<div class="flex justify-center my-10">
    <form action="{{ route('category.store') }}" method="POST" id="category-form" class="w-1/2">
        @csrf
        <div class="mb-4">
            <label for="category" class="block text-gray-700">Category:</label>
            <input type="text" name="category" id="category" class="border border-gray-300 rounded-md px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-4">
            <label for="products" class="block text-gray-700">Select Products:</label>
            @foreach ($products as $product)
            <div class="flex items-center">
                <input type="checkbox" name="name[]" value="{{ $product['name'] }}" id="{{ $product['id'] }}" data-product-name="{{ $product['name'] }}" class="product-checkbox border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                <label for="{{ $product['id'] }}" class="ml-2">{{ $product['name'] }}</label>
            </div>
            @endforeach
        </div>
        <input type="hidden" name="selected_products" id="selected-products">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">Create Category</button>
    </form>
</div>
@endsection
