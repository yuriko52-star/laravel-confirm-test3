<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WeightTargetRequest;
use App\Models\WeightTarget;

class WeightTargetController extends Controller
{
     public function showGoalSettingForm()
    {
    $user_id = auth()->id();
    $weightTarget = WeightTarget::where('user_id', $user_id)->first();

        return view('change', compact('weightTarget'));
    } 

    public function goalSetting(WeightTargetRequest $request)
    {
        $user_id = auth()->id();
        $weightTarget = WeightTarget::where('user_id', $user_id)->first();

        if (!$weightTarget) {
            return redirect()->route('weight_logs.index')->withErrors('目標体重のデータが見つかりません。');
        }

        // データを更新
        $weightTarget->target_weight = $request->input('target_weight');
        $weightTarget->save();

        return redirect()->route('weight_logs.index')->with('status', '目標体重を更新しました！');
    }
}