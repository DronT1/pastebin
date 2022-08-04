<x-layouts.app>
    <div class="my-pastes">
        @if (!$pastes->count()) <h3>Паст нет</h3> @endif
        <ul>
        @foreach ($pastes as $pasta)
            <li>{{$pasta->id}} | {{$pasta->title}}</li>
        @endforeach
        </ul>
        {{$pastes->links()}}
    </div>
</x-layouts.app>
