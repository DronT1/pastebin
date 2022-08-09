<x-layouts.app>
<form action="{{route('home')}}" method="POST">
        @csrf
        <div>
            <h3>Новая паста</h3>
            <textarea name="description" id="" class="w-full h-300"></textarea>
        </div>
        <div>
            <span>Подсветка синтаксиса</span>
            <select name="syntax" id="syntax">
                <option value="1" data-language="text">Нет</option>
                <option value="2" data-language="c++">C++</option>
                <option value="3" data-language="python">Python</option>
                <option value="4" data-language="js">JavaScript</option>
                <option value="5" data-language="php">PHP</option>
                <option value="6" data-language="html">HTML</option>
            </select>
        </div>
        <div>
            <span>Срок окончания пасты</span>
            <select name="expiration" id="expiration">
                <option value="n">Никогда</option>
                <option value="10M">10 Минут</option>
                <option value="1H">1 Час</option>
                <option value="3H">3 Часа</option>
                <option value="1D">1 День</option>
                <option value="1W">1 Неделя</option>
                <option value="1M">1 Месяц</option>
            </select>
        </div>
        <div>
            <span>Доступность пасты</span>
            <select name="exposure" id="exposure">
                <option value="1">Публичная</option>
                <option value="2">По ссылке</option>
                @auth<option value="3">Приватная</option>@endauth
            </select>
        </div>
        <div>
            <span>Название пасты</span>
            <input type="text" name="title" placeholder="Title">
        </div>
        <button type="submit" class="border bg-blue-500 text-white text-lg rounded-lg px-5 py-1 w-full my-2 block">Создать пасту</button>
    </form>
    @if(isset($pasteLink))
        <div class="my-5">
            <a href="{{$hash}}" class="">{{$pasteLink}}{{$hash}}</a>
        </div>
    @endif
</x-layouts.app>
