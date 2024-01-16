<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absent</title>
    @vite('resources/css/app.css')
</head>

<body>


    <div>
        <h3 class="text-lg font-bold">Absent Staff:</h3>
        <ul class="mt-4 space-y-4">
            @foreach ($absentUsers as $user)
            <li class="border border-gray-200 p-4 rounded flex items-center">
                <div class="font-bold mr-2">Name:</div>
                <div>{{ $user['name'] }}</div>
                <div class="text-gray-500 ml-4">Start Time: {{ $user['start_time'] }}</div>
                <div class="text-gray-500 ml-4">End Time: {{ $user['end_time'] }}</div>
            </li>
            @endforeach
        </ul>
    </div>

</body>

</html>
