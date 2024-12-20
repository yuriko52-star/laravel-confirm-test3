<?php

namespace App\Services;

use App\Models\WeightLog;
use App\Models\WeightTarget;

class WeightLogService
{
    /**
     * ユーザーの体重差や最新体重データを計算
     *
     * @param int $userId
     * @return array
     */
    public static function calculateWeightData(int $userId): array
    {
        // 最新体重ログの取得
        $latestLog = WeightLog::where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->first();

        $latestWeightOverall = $latestLog ? $latestLog->weight : null;
        // 目標体重の取得
        $weightTarget = WeightTarget::where('user_id', $userId)->first();

        // 体重差の計算
        $weightDifference = $weightTarget && $latestWeightOverall
            ? $latestWeightOverall - $weightTarget->target_weight
            : null;

        return [
            'latestWeightOverall' => $latestWeightOverall,
            'weightTarget' => $weightTarget,
            'weightDifference' => $weightDifference,
        ];
    }
}
