@extends('layouts.app')

@section('top-controls')
    <a href="/home" class="bg-blue-500 text-white py-2 px-4 rounded mr-2">{{ __('home.departments') }}</a>
    <a href="/departments/create" class="bg-green-500 text-white py-2 px-4 rounded">{{ __('home.create_department') }}</a>
@endsection

@section('content')
    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-semibold mb-4">{{ isset($department) ? __('departments.edit_department') : __('departments.create_department') }}</h1>
        
        <div class="bg-white shadow-md rounded-lg overflow-hidden py-4 px-4 border border-gray-200">
            <form action="{{ isset($department) ? '/departments/'.$department->id : '/departments' }}" method="POST">
                @csrf

                @if(isset($department))
                    @method('PUT')
                @endif

                <div class="flex">
                    <div class="flex-1 mr-2">
                        <div class="mb-4">
                            <label for="parent_id" class="block text-sm font-medium text-gray-600">{{ __('departments.parent') }}</label>
                            <select name="parent_id" id="parent_id" class="mt-1 p-2 w-full border rounded-md">
                                <option value="">None</option>
                                @foreach($departments as $d)
                                    <option value="{{ $d->id }}" {{ isset($department) && $department->parent_id == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex-1 mr-2">
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-600">{{ __('departments.name') }}</label>
                            <input type="text" name="name" id="name" class="mt-1 p-2 w-full border rounded-md" value="{{ isset($department) ? $department->name : old('name') }}" required>
                        </div>
                    </div>
                </div>
                
                
                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">
                        @if(isset($department))
                            {{ __('general.update') }}
                        @else
                            {{ __('general.create') }}
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
