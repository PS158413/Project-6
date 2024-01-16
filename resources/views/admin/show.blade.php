@extends('layouts.app')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @elseif (session('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <div class="container mx-auto mt-10 w-full max-w-3xl">
        <a href="{{ route('get.orders') }}" class="">
            <button class="bg-Electric_Blue text-white px-4 py-2 rounded-md font-bold text-sm uppercase mt-4 flex space-x-2">Back</button>
        </a>
    </div>

    <div class="container mx-auto my-10">
        <div class="flex justify-center">
            <div class="w-full max-w-3xl">
                <div class="bg-[#f1f1f1] shadow-md rounded-lg px-4 py-6">
                    <h2 class="text-2xl font-bold mb-4">Order details</h2>
                    <div class="bg-white shadow-md rounded-lg px-4 py-6">
                            <h3 class="text-xl font-bold mb-2">Order ID</h3>
                            <h4 class="text-gray-500 font-semibold text-sm">{{$orderItems[0]['order_id'] }}</h4>
                    </div>
                    </table>
                    <h2 class="text-2xl font-bold my-4">Products</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($orderItems as $orderitem)
                            @foreach($products as $product)
                                @if($product['id'] == $orderitem['product_id'])
                                    <div class="bg-white shadow-md rounded-lg px-4 py-6">
                                        <h3 class="text-xl font-bold mb-2">{{ $product['name'] }}</h3>
                                        <p class="text-gray-500 font-semibold text-sm">Price: €{{ $product['price'] }}</p>
                                        <p class="text-gray-500 font-semibold text-sm">Quantity: {{ $orderitem['quantity'] }}</p>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>

{{--                @if($orderItems[0]['status'] == 'completed')--}}
{{--                    <a href="{{ route('sync.products', $orderitem['order_id'])}}">--}}
{{--                        <button class="bg-Electric_Blue text-white px-4 py-2 rounded-md font-bold text-sm uppercase mt-4">Sync prodcten</button>--}}
{{--                    </a>--}}
{{--                @else--}}
{{--                    <a href="{{ route('sync.products', $orderitem['order_id'])}}">--}}
{{--                        <button class="bg-red-600 pointer-events-none text-white px-4 py-2 rounded-md font-bold text-sm uppercase mt-4">Sync prodcten</button>--}}
{{--                    </a>--}}
{{--                @endif--}}

                <a href="{{ route('sync.products', $orderitem['order_id'])}}">
                <button class="bg-Electric_Blue text-white px-4 py-2 rounded-md font-bold text-sm uppercase mt-4">
                    Sync prodcten</button>
                 </a>
            </div>

        </div>
    </div>
@endsection
