@extends('layouts.app')

@section('top-controls')
    <a href="/home" class="bg-blue-500 text-white py-2 px-4 rounded mr-2">{{ __('home.departments') }}</a>
    <a href="/users" class="bg-blue-500 text-white py-2 px-4 rounded mr-2">{{ __('home.users') }}</a>
@endsection

@section('content')
    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-semibold mb-4">{{__('departments.manage_users_for_department_x', ["department" => $department->name] )}}</h1>
        
        <div class="bg-white shadow-md rounded-lg overflow-hidden py-4 px-4 border border-gray-200">
            <div class="grid grid-cols-12 gap-3">
                <div class="col-span-2 border-r pr-3">
                    @if($usersNotInDepartment->isNotEmpty())
                        <form action="/departments/{{$department->id}}/users" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="user_id" class="block text-sm font-medium text-gray-600">{{ __('departments.add_user') }}</label>
                                <select name="user_id" id="user_id" class="mt-1 p-2 w-full border rounded-md">
                                    @foreach($usersNotInDepartment as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div >
                                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">{{ __('departments.add') }}</button>
                            </div>
                        </form>
                    @else
                        {{ __('departments.all_users_are_asigned_on_this_department') }}
                    @endif
                </div>
            
                <div class="col-span-10 @if($department->users()->count() == 0) flex items-center justify-center @endif">
                    @if($department->users()->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-8 xl:grid-cols-8 gap-4">
                        @foreach($department->users as $user)
                        <div class="relative bg-white shadow-md rounded-lg overflow-hidden p-4 border border-gray-200">
                            <p class="text-gray-800">{{ $user->name }}</p>
                            <form action="/departments/{{ $department->id }}/users/{{ $user->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button title="{{ __('departments.remove_from_department') }}" type="submit" class="absolute top-2 right-2 text-red-500 hover:text-red-700">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                    @else
                        <div class="text-center">
                            <p class="text-gray-500">{{ __('departments.no_users_assigned_to_the_department') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
