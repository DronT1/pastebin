<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use App\Services\PasteService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PasteController extends Controller
{
    protected $pasteService;

    public function __construct(PasteService $pasteService)
    {
        $this->pasteService = $pasteService;
    }

    public function myPastes()
    {
        $pastes = $this->pasteService->myPastes();
        return view('my-pastes', compact('pastes'));
    }

    public function myLastPastes()
    {
        $pastes = $this->pasteService->myLastPastes();

        if (!$pastes->count()) {
            return json_encode(['message' => 'Результатов нет']);
        }

        return $pastes->toJson();
    }

    public function lastPastes()
    {
        $pastes = $this->pasteService->lastPastes();

        if (!$pastes->count()) {
            return json_encode(['message' => 'Результатов нет']);
        }

        return $pastes->toJson();
    }

    public function showPaste($hash)
    {
        $userId = Auth::id();
        $paste = $this->pasteService->showPaste($hash, $userId);

        if (!$paste) {
            $errorAccess = 1;
            return view('paste', compact('errorAccess'));
        }

        return \view('paste', compact('paste'));
    }

    public function createPaste(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'syntax' => ['integer'],
            'exposure' => ['integer'],
            'expiration' => ''
        ]);

        $userId = Auth::id();
        $paste = $this->pasteService->createPaste($data, $userId);

        if (!$paste) {
            return redirect()->back()->withErrors([
                'create-paste' => 'Ошибка создания пасты'
            ]);
        }

        return to_route('paste', $paste);
    }
}
