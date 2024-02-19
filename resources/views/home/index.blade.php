@extends('layouts.app')

@section('top-controls')
    <a href="/users" class="bg-blue-500 text-white py-2 px-4 rounded mr-2">{{ __('home.users') }}</a>
    <a href="/departments/create" class="bg-green-500 text-white py-2 px-4 rounded">{{ __('home.create_department') }}</a>
@endsection

@section('content')
    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-semibold mb-4">{{ __('home.title') }}</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-6 text-left border-b">{{ __('departments.name') }}</th>
                        <th class="py-3 px-6 text-left border-b">{{ __('departments.parent') }}</th>
                        <th class="py-3 px-6 text-left border-b">{{ __('general.users') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    @foreach($departments as $department)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                            <td class="py-4 px-6">{{ $department->name }}</td>
                            <td class="py-4 px-6">{{ $department->parent?->name ?? "-"}}</td>
                            <td class="py-4 px-6">{{ $department->users()->count() }}</td>
                            <td class="py-4 px-6 text-right">
                                <a href="/departments/{{$department->id}}/users/manage"><i title="{{ __('home.manage_users') }}" class="fa-solid fa-people-roof text-blue-500 cursor-pointer"></i></a>
                                <a href="/departments/{{$department->id}}/edit"><i title="{{ __('home.edit_department') }}" class="ml-2 fas fa-edit text-blue-500 cursor-pointer"></i></a>
                                <form action="/departments/{{$department->id}}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="{{ __('home.delete_department') }}" class="ml-2 fas fa-trash text-red-500 cursor-pointer"></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
