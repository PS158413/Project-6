@section('content')
    @extends('layouts.app')
    <div class="flex items-center justify-center min-h-screen">
        <form action="{{ route('user.update', $user['id']) }}" method="POST" class="w-full max-w-md mx-auto">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="role" class="block text-gray-700">Role</label>
                <select name="name" id="name" required class="block w-full px-4 py-2 border rounded-lg border-gray-300 focus:outline-none focus:border-blue-500">
                    @foreach ($roles as $role)
                        <option value="{{ $role['name'] }}" {{ $role['name'] === $user['role'][0]['name'] ? 'selected' : '' }}>{{ $role['name'] }}</option>
                    @endforeach
                </select>
                @error('role')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-lg">Update User</button>
            </div>
        </form>
    </div>
@stop
