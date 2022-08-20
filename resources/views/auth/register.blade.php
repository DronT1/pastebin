<x-layouts.app>
    <h1 class="text-4xl mb-5">Регистрация</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route("auth.register")}}" method="POST">
        @csrf
        <label class="border text-lg rounded-lg px-5 py-1 w-full my-2 block">
            <input type="text" name="login" placeholder="Логин">
        </label>
        <label class="border text-lg rounded-lg px-5 py-1 w-full my-2 block">
            <input type="password" name="password" placeholder="Пароль">
        </label>
        <label class="border text-lg rounded-lg px-5 py-1 w-full my-2 block">
            <input type="password" name="password_confirmation" placeholder="Повторите пароль">
        </label>
        <button type="submit" class="border bg-blue-500 text-white text-lg rounded-lg px-5 py-1 w-full my-2 block">Зарегистрироваться</button>
    </form>
</x-layouts.app>
