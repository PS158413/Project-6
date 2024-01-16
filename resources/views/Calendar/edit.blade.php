<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    @vite('resources/css/app.css')
</head>

<body class="">

    <form action="{{ route('update', $absence['id']) }}" method="POST" class="mt-52 max-w-md mx-auto bg-white shadow-md rounded-lg px-8 py-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
            <h1 class="text-2xl font-bold">Edit Absence</h1>
        </div>

        <div class="mb-4">
            <label for="absence" class="block text-sm font-medium text-gray-700">Absence:</label>
            <input type="text" name="absence" id="absence" value="{{ $absence['absence'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="mb-4">
            <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time:</label>
            <input lang="nl" type="datetime-local" name="start_time" id="start_time" value="{{ $absence['start_time'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="mb-4">
            <label for="finish_time" class="block text-sm font-medium text-gray-700">Finish Time:</label>
            <input lang="nl" type="datetime-local" name="finish_time" id="finish_time" value="{{ $absence['finish_time'] }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update Absence</button>
        </div>

        <div class="mt-4">
            <a href="{{ route('calender') }}" class="text-indigo-500 hover:text-indigo-700">Back to Calendar</a>
        </div>
    </form>

    <div class="mt-2 flex flex-col items-center">
        <form action="{{ route('destroy', $absence['id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this absence?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-700">Delete Absence</button>
        </form>


    </div>



</body>

</html>
