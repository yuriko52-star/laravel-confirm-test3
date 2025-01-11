<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{   // Step1: 名前、メールアドレス、パスワード入力フォーム表示
     public function showStep1()
    {
        return view('auth.register1');
    } 
     public function processStep1(Request $request, CreateNewUser $createNewUser)
    {
        //  バリデーション（CreateNewUser内で処理される）
        $user = $createNewUser->create($request->all());
        // セッションにユーザーIDを保存（Step2で利用するため）
        Session::put('user_id', $user->id);
        // Step2にリダイレクト
        return redirect()->route('register.step2');
    }

    // Step2: 体重情報入力フォーム表示
    public function showStep2()
    {
        return view('auth.register2');
    }

    // Step2: データ処理
    public function processStep2(RegistrationRequest $request)
    {
        // セッションからユーザーIDを取得
    $user_id = Session::get('user_id');
    if (!$user_id) {
        return redirect()->route('register.step1')->withErrors('ユーザーが見つかりません。最初からやり直してください。');
    }
     // ユーザーを取得
    $user = User::find($user_id);
        if (!$user) {
        return redirect()->route('register.step1')->withErrors('ユーザーが存在しません。');
        }
    // 体重情報を保存 (関連テーブルに保存)
        $user->weightLogs()->create([
            'weight' => $request->current_weight,
            'date'=> now(),
            'calories' => $request->calories ?? 0,
            'exercise_time' => $request->exercise_time ?? 0,
            'exercise_content' => $request->exercise_content ?? '',
        ]);

        $user->weightTarget()->create([
            'target_weight' => $request->target_weight,

        ]);
        // Auth::login($user);
        // セッションを削除してメインページにリダイレクト
        // $request->session()->forget('user_data');
        
        return redirect()->route('weight_logs.index')->with('status', '登録が完了しました！');
    }
}


        