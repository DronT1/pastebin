<x-layouts.app>
    <div class="my-pastes">
        @if (!$pastes->count()) <h3>Паст нет</h3> @endif
        <ul>
        @foreach ($pastes as $pasta)
            <li>{{$loop->iteration}} | <a href="/paste/{{$pasta->hash}}" style="text-decoration: underline;">{{$pasta->title}}</a></li>
        @endforeach
        </ul>
        {{$pastes->links()}}
    </div>
</x-layouts.app>
