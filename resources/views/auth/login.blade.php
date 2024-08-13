@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-2xl font-bold text-center mb-6">Login</h1>

            @if ($errors->any())
                <div class="mb-4">
                    @foreach ($errors->all() as $error)
                        <div class="text-red-600 font-semibold">{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-semibold mb-2">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
