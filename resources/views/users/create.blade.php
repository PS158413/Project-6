@section('content')
    @extends('layouts.app')

    <div class="flex items-center justify-center min-h-screen">
        <form action="{{ route('user.store') }}" method="POST" class="w-full max-w-md mx-auto">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="block w-full px-4 py-2 border rounded-lg border-gray-300 focus:outline-none focus:border-blue-500">
                @error('name')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="last_name" class="block text-gray-700">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required class="block w-full px-4 py-2 border rounded-lg border-gray-300 focus:outline-none focus:border-blue-500">
                @error('last_name')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="city" class="block text-gray-700">City</label>
                <input type="text" name="city" id="city" value="{{ old('city') }}" required class="block w-full px-4 py-2 border rounded-lg border-gray-300 focus:outline-none focus:border-blue-500">
                @error('city')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-gray-700">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required class="block w-full px-4 py-2 border rounded-lg border-gray-300 focus:outline-none focus:border-blue-500">
                @error('phone')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="birthday" class="block text-gray-700">Phone</label>
                <input type="date" name="birthday" id="birthday" value="{{ old('birthday') }}" required class="block w-full px-4 py-2 border rounded-lg border-gray-300 focus:outline-none focus:border-blue-500">
                @error('birthday')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="block w-full px-4 py-2 border rounded-lg border-gray-300 focus:outline-none focus:border-blue-500">
                @error('email')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="block w-full px-4 py-2 border rounded-lg border-gray-300 focus:outline-none focus:border-blue-500">
                @error('password')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="block w-full px-4 py-2 border rounded-lg border-gray-300 focus:outline-none focus:border-blue-500">
                @error('password_confirmation')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="role" class="block text-gray-700">Role</label>
                <select name="role" id="role" required class="block w-full px-4 py-2 border rounded-lg border-gray-300 focus:outline-none focus:border-blue-500">
                    <option value="">Select Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role['name'] }}">{{ $role['name'] }}</option>
                    @endforeach
                </select>
                @error('role')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-lg">Create Staff</button>
            </div>
        </form>
    </div>
@stop
