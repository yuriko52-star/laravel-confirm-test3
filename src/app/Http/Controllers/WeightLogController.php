<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
class WeightLogController extends Controller
{
     public function index()
    {
        // ログイン中のユーザーIDを取得
        // $userId = auth()->id();
        $userId = 1; // 表示したいユーザーのIDを指定
        // weight_targetテーブルから対象ユーザーの目標体重を取得
        $weightTarget = WeightTarget::where('user_id', $userId)->first();

        // weight_logsテーブルから対象ユーザーのログを取得
        $weightLogs = WeightLog::where('user_id', $userId)->orderBy('date', 'desc')->paginate(8);

        // ビューにデータを渡す
        return view('admin', [
            'weightTarget' => $weightTarget,
            'weightLogs' => $weightLogs,
        ]);
    }
}
   