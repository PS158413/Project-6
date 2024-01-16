@extends('layouts.app')
@section('content')
   <div class="w-full mt-10">
       <img class="rounded-md " src="{{$product['image']}}" alt="">
       <h1 class="text-xl font-semibold">{{$product['name']}}</h1>
       <p class="text-lg">{{$product['description']}}</p>
       <p>€ {{$product['price']}}</p>
   </div>
@endsection
