<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absence</title>
    @vite('resources/css/app.css')
</head>

<body>

    <form action="{{ route('store') }}" method="POST" class=" mt-52 max-w-md mx-auto bg-white shadow-md rounded px-8 py-6">
        @csrf
        <div class="mb-4">
            <label for="absence" class="block mb-2 text-sm font-medium text-gray-700">Absence:</label>
            <input type="text" name="absence" id="absence" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="start_time" class="block mb-2 text-sm font-medium text-gray-700">Start Time:</label>
            <input lang="nl" type="datetime-local" name="start_time" id="start_time" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div class="mb-4">
            <label for="finish_time" class="block mb-2 text-sm font-medium text-gray-700">Finish Time:</label>
            <input lang="nl" type="datetime-local" name="finish_time" id="finish_time" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Create</button>
        </div>

        <div class="mt-4">
            <a href="{{ route('calender') }}" class="text-indigo-500 hover:text-indigo-700">Back to Calendar</a>
        </div>
    </form>

</body>

</html>
