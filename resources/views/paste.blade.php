<x-layouts.app>
    <div>
        @if (isset($errorAccess)) <h3>Ссылка недоступна!</h3>
        @else
            <div>
                <h2>{{$paste['title']}}</h2>
                <p>Срок пасты истекает: {{$paste['expiration']}}</p>
                <div style="max-width: 800px;">
                    <pre>
                        <code class="{{$paste['syntax']}}">
                            {{$paste['description']}}
                        </code>
                    </pre>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
