<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MainController extends Controller
{
    private Request $request;
    private $currentDate;
    private $defaultExpirationDate;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->currentDate = Carbon::now()->toDateTimeString();
        $this->defaultExpirationDate = Carbon::create('0001','01','01','00','00','00')->toDateTimeString();
    }

    public function index(Request $request)
    {
        return view('home');
    }

    public function register()
    {
        return \view('auth.register');
    }

    public function registration(Request $request)
    {
        // dd($request->all());
        $user = User::create([
            'login' => $request->get('login'),
            'password' => Hash::make($request->get('password'))
        ]);
        \Auth::login($user);
        return to_route('home');
    }

    public function login()
    {
        return \view('auth.login');
    }

    public function auth()
    {
        $user = User::where('login', $this->request->get('login'))->first();

        if (!$user || !\Hash::check($this->request->get('password'), $user->password)) {
            \Session::flash('error', 'Неверный логин или пароль');
            return redirect()->back();
        }

        \Auth::login($user);
        return to_route('home');
    }

    public function logout()
    {
        \Auth::logout();
        return to_route('home');
    }

    public function myPastes()
    {
        $pastes = Paste::where('user_id', \Auth::id())
            ->where(function ($query) {
                $query->where('expiration', '>', $this->currentDate)
                    ->orWhere('expiration', '=', $this->defaultExpirationDate);
            })->orderByDesc('id')->paginate(10);
//        dd($pastes->toArray());
        $pastesData = [];

//        if ($pastes->count()) $pastesData = $pastes->toArray();
        return view('my-pastes', compact('pastes'));
    }

    public function lastPastes()
    {
        $pastes = Paste::where('exposure', 'public')
            ->where(function ($query) {
                $query->where('expiration', '>', $this->currentDate)
                    ->orWhere('expiration', '=', $this->defaultExpirationDate);
            })->orderByDesc('id')->limit(10)->get(['id', 'title', 'hash', 'syntax', 'expiration']);
//        dd($pastes->count());
        if (!$pastes->count()) return json_encode(['message' => 'Результатов нет']);
        return $pastes->toJson();
    }

    public function showPaste(Request $request, $hash)
    {
        $isAuth = \Auth::id();

        $paste = Paste::where(function ($query) use ($hash, $isAuth) {
           $query->where('hash', $hash);
            if (!$isAuth) $query->where('exposure', 'not like', 'private');
        })->where(function ($query) {
            $query->where('expiration', '>', $this->currentDate)
                ->orWhere('expiration', '=', $this->defaultExpirationDate);
        })->first();

        $errorAccess = 0;
        $pasteData = [];
        if (!$paste || $paste->exposure == 'private' && $isAuth != $paste->user_id) $errorAccess = 1;
        else $pasteData = $paste->toArray();
        return \view('paste', compact('errorAccess', 'pasteData'));
    }

    public function createPaste(Request $request)
    {
        $params = [
            "syntax" => [
                "1" => "text",
                "2" => "c++",
                "3" => "python",
                "4" => "js",
                "5" => "php"
            ],
            "expiration" => [
                "n" => $this->defaultExpirationDate,
                "10M" => Carbon::now()->addMinute(10)->toDateTimeString(),
                "1H" => Carbon::now()->addHour(1)->toDateTimeString(),
                "3H" => Carbon::now()->addHour(3)->toDateTimeString(),
                "1D" => Carbon::now()->addDay(1)->toDateTimeString(),
                "1W" => Carbon::now()->addWeek(1)->toDateTimeString(),
                "1M" => Carbon::now()->addMonth(1)->toDateTimeString()
            ],
            "exposure" => [
                "1" => "public",
                "2" => "unlisted",
                "3" => "private"
            ]
        ];

        $objPaste = [];

        foreach ($request->all() as $key => $item) {
            if (array_key_exists($key, $params)) {
                $objPaste[$key] = $params[$key][$item];
            }
        }

        $objPaste["description"] = $request->get("description");
        $objPaste["title"] = $request->get("title");
        $objPaste["hash"] = Str::random(8);
        $userId = \Auth::id();
        if ($userId) $objPaste["user_id"] = $userId;
        // dd($objPaste);
        $paste = Paste::create($objPaste);
        if ($paste) {
//            $pasteLink = $request->getHttpHost();
//            $hash = "/paste/" . $objPaste["hash"];
//            return to_route('home', compact('pasteLink'));
//            return \view('home', compact('pasteLink', 'hash'));
            return to_route('paste', $objPaste['hash']);
        }
    }
}
