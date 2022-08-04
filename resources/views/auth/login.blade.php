<x-layouts.app>
    <h1 class="text-4xl mb-5">Авторизация</h1>
    <form action="{{route("auth.login")}}" method="POST">
        @csrf
        <label class="border text-lg rounded-lg px-5 py-1 w-full my-2 block">
            <input type="text" name="login" placeholder="Логин">
        </label>
        <label class="border text-lg rounded-lg px-5 py-1 w-full my-2 block">
            <input type="password" name="password" placeholder="Пароль">
        </label>
        <button type="submit" class="border bg-blue-500 text-white text-lg rounded-lg px-5 py-1 w-full my-2 block">Войти</button>
    </form>
</x-layouts.app>