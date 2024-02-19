@extends('layouts.app')

@section('top-controls')
    <a href="/home" class="bg-blue-500 text-white py-2 px-4 rounded mr-2">{{ __('home.departments') }}</a>
    <a href="/users" class="bg-blue-500 text-white py-2 px-4 rounded mr-2">{{ __('home.users') }}</a>
@endsection

@section('content')
    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-semibold mb-4">{{__('departments.show_hierarchy')}}</h1>
        
        <div class="bg-white shadow-md rounded-lg overflow-hidden py-4 px-4 border border-gray-200">
            @include('departments.partials.recursive_hierarchy', ['hierarchy' => $hierarchy])
        </div>
    </div>
@endsection
