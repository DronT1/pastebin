<?php

namespace App\Services;

use App\Models\Paste;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PasteService
{
    private $currentDate;

    public function __construct()
    {
        $this->currentDate = Carbon::now()->toDateTimeString();
    }

    public function toNeverTime($stringTime)
    {
        if ($stringTime === null) {
            $stringTime = "Никогда";
        }
        return $stringTime;
    }

    public function queryPaste($userId = null, $paginate = null, $limit = null)
    {
        $pastes = Paste::where(function ($query) use ($userId) {
            if ($userId) {
                $query->where('user_id', $userId);
            } else {
                $query->where('exposure', 'public');
            }})->where(function ($query) {
            $query->where('expiration', '>', $this->currentDate)
                ->orWhere('expiration', '=', null);
        })->orderByDesc('id');

        if ($paginate && !$limit) {
            $pastes = $pastes->paginate($paginate);
        }

        if ($limit) {
            $pastes = $pastes->limit($limit)->get(['id', 'title', 'hash', 'syntax', 'expiration']);
        }

        return $pastes;
    }

    public function myPastes($userId)
    {
        $pastes = $this->queryPaste($userId, 10);
        return $pastes;
    }

    public function myLastPastes($userId)
    {
        $pastes = $this->queryPaste($userId, null, 10);
        return $pastes;
    }

    public function lastPastes()
    {
        $pastes = $this->queryPaste(null, null, 10);
        return $pastes;
    }

    public function showPaste(string $hash, $userId)
    {
        $paste = Paste::where(function ($query) use ($hash, $userId) {
            $query->where('hash', $hash);
            if (!$userId) {
                $query->where('exposure', 'not like', 'private');
            }
        })->where(function ($query) {
            $query->where('expiration', '>', $this->currentDate)
                ->orWhere('expiration', '=', null);
        })->first();

        if (!$paste || $paste->exposure == 'private' && $userId != $paste->user_id) {
            return false;
        }

        $pasteData = $paste->toArray();
        $pasteData['expiration'] = $this->toNeverTime($pasteData['expiration']);

        return $pasteData;
    }

    public function createPaste(array $data, $userId)
    {
        $syntax = [
            "1" => "text",
            "2" => "c++",
            "3" => "python",
            "4" => "js",
            "5" => "php",
            "6" => "html"
        ];

        $exposure = [
            "1" => "public",
            "2" => "unlisted",
            "3" => "private"
        ];

        $data['syntax'] = $syntax[$data['syntax']];
        $data['exposure'] = $exposure[$data['exposure']];
        $data['hash'] = Str::random(8);

        if ($userId) {
            $data['user_id'] = $userId;
        }

        $data['expiration'] = $data['expiration'] === 'n' ? null : Carbon::now()->add($data['expiration'])->toDateTimeString();
        $paste = Paste::create($data);

        if (!$paste) {
            return false;
        }

        return $data['hash'];
    }
}
