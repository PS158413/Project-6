@extends('layouts.app')

@section('content')

    @if(session('success'))
        <script>
            swal({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
            });
        </script>
    @elseif (session('error'))
        <script>
            swal({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error",
            });
        </script>
    @endif


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


    <!-- Search form -->
    <div class="flex justify-center mt-10">
        <form class="my-4" action="{{ route('admin.index') }}" method="GET">
            <label for="q" class="sr-only">Search</label>
            <input type="text" id="q" name="q"
                   class="border h-10 border-gray-300 rounded-md focus:border-Electric_Blue focus:ring focus:ring-Electric_Blue focus:ring-opacity-50 px-4"
                   placeholder="zoek producten">
            <button type="submit" class="px-4 py-2 bg-Electric_Blue text-white rounded-md hover:bg-opacity-75">Zoek
            </button>
        </form>
    </div>
    <form action="{{ route('store.order') }}" method="POST" class="relative">
        @csrf
        <table class="w-[90%] mx-auto mt-5">
            <tr class="bg-bg_partial text-Electric_Blue uppercase border border-black">
                <th  class="text-left w-auto py-4 pl-3">Inzien</th>
                <th class="text-left w-auto py-4 pl-3">Producten</th>
                <th class="text-left w-auto py-4">Omschrijving</th>
                <th class="text-left w-auto py-4 pr-10">Bestellen</th>
            </tr>
            @foreach ($products as $product)
                <tbody class="bg-gray-100 even:bg-gray-300">

                <tr class="border border-b-1 border-black">
                    <fieldset>

                        <td class="text-left py-2 pl-3"> <a href="{{route('showkuin.product', $product['id'] )}}"> Inzien</a> </td>
                        <td class="text-left py-2 pl-3">{{ $product['name'] }}</td>

                            <td class="text-left py-2">{{ $product['description'] }}</td>

                        <td>
                            <input type="checkbox" onchange="addinput(this);" id="product{{ $product['id'] }}"
                                   value="{{ $product['id'] }}" name="selected[]" class="pr-10"/>
                        </td>
                    </fieldset>
                </tr>

                </tbody>
                <script>
                    function addinput(sender) {
                        if (sender.checked) {
                            var input = document.createElement("input");
                            input.id = 'quantity_{{$product['id']}}';
                            input.type = 'number';
                            input.name = 'quantity[]';
                            input.placeholder = 'Aantal';
                            //add class to the input
                            input.classList.add("quantity_field");
                            sender.parentNode.appendChild(input);
                        } else {
                            //remove the input
                            sender.parentNode.removeChild(sender.parentNode.lastChild);
                        }
                    }
                </script>
            @endforeach
        </table>
        <ul>
            <div class="flex justify-center my-6">
                <div class="flex">
                    {{ $products->links() }}
                </div>
            </div>
        </ul>
        <div class="w-full flex justify-center mb-10">
            <button class="py-2 px-6 text-xl rounded-md bg-Electric_Blue text-white hover:bg-blue-600 uppercase"
                    type="submit">Bestelling Plaatsen
            </button>
        </div>
    </form>
@endsection
