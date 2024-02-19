@extends('layouts.app')

@section('top-controls')
    <a href="/users" class="bg-blue-500 text-white py-2 px-4 rounded mr-2">{{ __('home.users') }}</a>
    <a href="/departments/create" class="bg-green-500 text-white py-2 px-4 rounded">{{ __('home.create_department') }}</a>
@endsection

@section('content')
    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-semibold mb-4">{{ isset($user) ? __('users.edit_user') : __('users.create_user') }}</h1>
        
        <div class="bg-white shadow-md rounded-lg overflow-hidden py-4 px-4 border border-gray-200">
            <form action="{{ isset($user) ? '/users/'.$user->id : '/users' }}" method="POST">
                @csrf

                @if(isset($user))
                    @method('PUT')
                @endif

                <div class="flex">
                    <div class="flex-1 mr-2">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-600">{{ __('users.name') }}</label>
                            <input type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-md" value="{{ isset($user) ? $user->name : old('name') }}" required>
                        </div>
                    </div>
                    <div class="flex-1 mr-2">
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-600">{{ __('users.email') }}</label>
                            <input type="email" name="email" id="email" class="mt-1 p-2 w-full border rounded-md" value="{{ isset($user) ? $user->email : old('email') }}" required>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-600">{{ __('users.password') }}</label>
                            <input type="password" name="password" id="password" class="mt-1 p-2 w-full border rounded-md" {{ isset($user) ? '' : 'required' }}>
                        </div>
                    </div>
                </div>

                {{-- Add more fields as needed --}}
                
                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">{{ __('general.create') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
