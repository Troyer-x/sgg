<ul class="list-inside list-disc ml-4">
    @foreach ($hierarchy as $department)
        <li class="mb-2">
            <a class="text-sky-800" href="/departments/{{$department["id"]}}/edit">{{ $department['name'] }}</a>
            @if (!empty($department['children']))
                @include('departments.partials.recursive_hierarchy', ['hierarchy' => $department['children']])
            @endif
        </li>
    @endforeach
</ul>
