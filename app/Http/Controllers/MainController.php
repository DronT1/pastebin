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
    public function index(Request $request)
    {
        return view('home');
    }
}
