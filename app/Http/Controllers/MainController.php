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

    public function __construct(Request $request) 
    {
        $this->request = $request;
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
        return view('my-pastes');
    }

    public function createPaste(Request $request)
    {
        // dd($request->all());
        $params = [
            "syntax" => [
                "1" => "text",
                "2" => "c++",
                "3" => "python",
                "4" => "js",
                "5" => "php"
            ],
            "expiration" => [
                "n" => null,
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

        // $arrExpiration = [
        //     "n" => null,
        //     "10M" => Carbon::now()->addMinute(10),
        //     "1H" => Carbon::now()->addHour(1),
        //     "3H" => Carbon::now()->addHour(3),
        //     "1D" => Carbon::now()->addDay(1),
        //     "1W" => Carbon::now()->addWeek(1),
        //     "1M" => Carbon::now()->addMonth(1)
        // ];

        // $arrSyntax = [
        //     "1" => "text",
        //     "2" => "c++",
        //     "3" => "python",
        //     "4" => "js"
        // ];

        // $arrExposure = [
        //     "1" => "public",
        //     "2" => "unlisted",
        //     "3" => "private"
        // ];

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
        // dd($paste);
        return to_route('home');
        // return view('welcome');
    }
}
