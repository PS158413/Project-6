@section('content')
@extends('layouts.app')
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

        </h2>
    </x-slot>

   <div class="flex">
    <a href="{{ route('absent.users') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
       <p>Absent Staff</p>
    </a>

    <a href="{{ route('calender') }}" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Go to Calendar
    </a>
</div>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-2xl font-bold">Dashboard</h1>
                <p class="text-xl text-gray-500">Welkom {{ session('SESSION_USER') }}</p>
            </div>
        </div>
    </div>
</div>

</div>
@stop
