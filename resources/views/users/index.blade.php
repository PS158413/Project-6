@section('content')
    @extends('layouts.app')



    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-3">gebruikers lijst</h1>
        <div class="mb-3">
            <form id="filter-form" action="{{ route('user.index') }}" method="GET">
                <select class="border border-Electric_Blue rounded-md p-1" name="role" id="role">
                    <option class="border-gray-300" value="">All</option>
                    @foreach ($roleData as $role)
                        <option value="{{ $role['id'] }}" {{ $selectedRoleId == $role['id'] ? 'selected' : '' }}>
                            {{ $role['name'] }}
                        </option>
                    @endforeach
                </select>
            </form>

        </div>
        <div class="mb-10">
            <a href="{{ route('user.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded my-10">Gebruiker aanmaken</a>
        </div>
        <table class="table-auto w-full border border-collapse mb-10">
            <thead>
            <tr>
                <th class="px-2 py-2 border">Name</th>
                <th class="px-2 py-2 border">Last Name</th>
                <th class="px-2 py-2 border">Email</th>
                <th class="px-2 py-2 border">City</th>
                <th class="px-2 py-2 border">Birthday</th>
                <th class="px-2 py-2 border">Phone</th>
                <th class="px-2 py-2 border">Role</th>
                @if (session('SESSION_USER_ROLE') === 'superadmin')
                    <th class="px-3 py-2 border">Action</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($userData as $index => $user)
                <tr>
                    <td class="px-2 py-2 border text-sm">{{ $user['name'] }}</td>
                    <td class="px-2 py-2 border text-sm">{{ $user['last_name'] }}</td>
                    <td class="px-2 py-2 border text-sm">{{ $user['email'] }}</td>
                    <td class="px-2 py-2 border text-sm">{{ $user['city'] }}</td>
                    <td class="px-2 py-2 border text-sm">{{ $user['birthday'] }}</td>
                    <td class="px-2 py-2 border text-sm">{{ $user['phone'] }}</td>
                    <td class="px-2 py-2 border text-sm">{{ implode(', ', array_column($user['role'], 'name')) }}</td>
                    @if (session('SESSION_USER_ROLE') === 'superadmin')
                        <td class="px-2 py-2 border">
                            <form action="{{ route('user.destroy', $user['id']) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-2 rounded">Delete</button>
                            </form>
                        </td>
                        <td class="px-2 py-2 border">
                            <form action="{{ route('user.edit', $user['id']) }}" method="POST" class="inline">
                                @csrf
                                @method('GET')
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-2 rounded">Edit</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('role').addEventListener('change', function() {
            document.getElementById('filter-form').submit();
        });
    </script>


    @stop
