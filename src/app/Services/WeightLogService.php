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
        
        $latestLog = WeightLog::where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->first();

        $latestWeightOverall = $latestLog ? $latestLog->weight : null;
       
        $weightTarget = WeightTarget::where('user_id', $userId)->first();

        
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
