<x-layouts.app>
    <div>
        @if ($errorAccess) <h3>Ссылка недоступна!</h3>
        @else
            <div>
                <h2>{{$pasteData['title']}}</h2>
                <p>Срок пасты истекает: {{$pasteData['expiration']}}</p>
                <div style="max-width: 800px;">
                    <pre>
                        <code class="{{$pasteData['syntax']}}">
                            {{$pasteData['description']}}
                        </code>
                    </pre>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
