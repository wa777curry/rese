<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class ShopController extends Controller
{
    public function index() {
        return view('index');
    }

    public function detail() {
        // 予約時間関連
        $startTime = strtotime('10:00'); // 開始時間
        $endTime = strtotime('22:00'); // 終了時間
        $interval = 2 * 60 * 60; // 2時間置きに設定
        $times = [];
        for ($time = $startTime; $time <= $endTime; $time += $interval) {
            $formattedTime = date('H:i', $time);
            $times[] = $formattedTime;
        }

        $numbers = array_merge(range(1, 9), ['10人以上']);
        return view('detail', compact('times', 'numbers'));
    }

    public function submit(Request $request) {
        return redirect()->route('done');
    }

    public function done() {
        return view('done');
    }
}

