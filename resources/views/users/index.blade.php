@extends('layouts.app')

@section('top-controls')
    <a href="/home" class="bg-blue-500 text-white py-2 px-4 rounded mr-2">{{ __('users.manage_departments') }}</a>
    <a href="/users/create" class="bg-green-500 text-white py-2 px-4 rounded">{{ __('users.create_user') }}</a>
@endsection

@section('content')
    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-semibold mb-4">{{ __('users.title') }}</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left border-b">{{ __('users.name') }}</th>
                        <th class="py-3 px-6 text-left border-b">{{ __('users.email') }}</th>
                        <th class="py-3 px-6 text-left border-b">{{ __('users.departments') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach($users as $user)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                            <td class="py-4 px-6">{{ $user->name }}</td>
                            <td class="py-4 px-6">{{ $user->email}}</td>
                            <td class="py-4 px-6">
                                @if($user->departments->isEmpty())
                                    <span class="text-gray-500">{{ __('users.no_departments') }}</span>
                                @else
                                    @foreach($user->departments as $department)
                                        <span class="text-blue-500 rounded-full py-1 text-xs font-bold mr-1">
                                            <a href="/department/{{$department->id}}/edit">{{ $department->name }}</a>
                                            @if(!$loop->last)
                                                <span class="text-gray-500">|</span>
                                            @endif
                                        </span>
                                    @endforeach
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="/users/{{$user->id}}/edit"><i title="{{ __('users.edit_user') }}" class="ml-2 fas fa-edit text-blue-500 cursor-pointer"></i></a>
                                <form action="/users/{{$user->id}}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="{{ __('users.delete_user') }}" class="ml-2 fas fa-trash text-red-500 cursor-pointer"></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
