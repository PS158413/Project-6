@extends('layouts.app')
@section('content')
    <table class="w-[90%] mx-auto my-10">
        <thead>
        <tr class="bg-bg_partial text-Electric_Blue uppercase border border-black">
            <th class="text-left w-auto py-4 pl-3">Bestelling ID</th>
            <th class="text-left w-auto py-4">Status</th>
            <th class="text-left w-auto py-4">Inzien</th>
        </tr>
        </thead>
        @foreach ($orders as $order)
            <tbody class="bg-gray-100 even:bg-gray-300">
            <tr class=" border border-b-1 border-black text-left">
                <td class="py-2 pl-5">{{ $order["id"] }}</td>
                <td class="py-2">{{ $order["status"] }}</td>
                <td class="py-2"> <a href="{{ route('show.order', $order['id']) }}"> <button class="py-2 px-4 text-md rounded-md bg-green-500 text-white hover:bg-green-700 font-medium">Inzien</button></a></td>
            </tr>
            </tbody>
        @endforeach
    </table>
    <div class="flex justify-center my-6">
        <div class="flex">
            {{ $orders->links() }}
        </div>
    </div>
@endsection

