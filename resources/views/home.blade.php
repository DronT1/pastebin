<x-layouts.app>
<form action="{{route('createPaste')}}" method="POST">
        @csrf
        <div>
            <h3>New Paste</h3>
            <textarea name="description" id="" cols="30" rows="10"></textarea>
        </div>
        <div>
            <span>Syntax Highlighting</span>
            <select name="syntax" id="syntax">
                <option value="1" data-language="text">None</option>
                <option value="2" data-language="c++">C++</option>
                <option value="3" data-language="python">Python</option>
                <option value="4" data-language="js">JavaScript</option>
                <option value="5" data-language="php">PHP</option>
            </select>
        </div>
        <div>
            <span>Paste Expiration</span>
            <select name="expiration" id="expiration">
                <option value="n">Never</option>
                <option value="10M">10 Minutes</option>
                <option value="1H">1 Hour</option>
                <option value="3H">3 Hour</option>
                <option value="1D">1 Day</option>
                <option value="1W">1 Week</option>
                <option value="1M">1 Month</option>
            </select>
        </div>
        <div>
            <span>Paste Exposure</span>
            <select name="exposure" id="exposure">
                <option value="1">Public</option>
                <option value="2">Unlisted</option>
                @auth<option value="3">Private</option>@endauth
            </select>
        </div>
        <div>
            <span>Paste title</span>
            <input type="text" name="title" placeholder="Title">
        </div>
        <button type="submit">Создать пасту</button>
    </form>
</x-layouts.app>