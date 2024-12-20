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
        
        // ログイン中のユーザーIDを取得fortifyを設定したらこのコードにする
        // $userId = auth()->id();
        $userId = 1; // 表示したいユーザーのIDを指定

       
        $weightLogs = WeightLog::where('user_id', $userId)->orderBy('date', 'asc')->paginate(8);

        
        $latestWeight = $weightLogs->last()->weight ?? null;
       
        $latestWeightOverall = WeightLog::where('user_id', $userId)
        ->orderBy('date', 'desc')
        ->first()->weight ?? null;
        
        $weightTarget = WeightTarget::where('user_id', $userId)->first();

      
        $weightDifference = $weightTarget && $latestWeightOverall
        ?  $latestWeightOverall - $weightTarget->target_weight
        : null;
       
        
        return view('admin', compact('weightLogs', 'latestWeightOverall', 'weightTarget', 'weightDifference'));


        
    }
   
    
    public function search(Request $request)
    { 
         // ログイン中のユーザーだけを取得
    // $user = auth()->user();
       $userId = 1; // 今だけ表示したいユーザーのIDを指定

        if ($request->has('reset')) {
            return redirect('/weight_logs');
        }   
        $weightTarget = WeightTarget::where('user_id', $userId)->first();
        $weightLogsAll = WeightLog::where('user_id', $userId)->orderBy('date', 'asc')->get();
         $latestWeightOverall = WeightLog::where('user_id', $userId)
        ->orderBy('date', 'desc') 
        
        ->first()->weight ?? null;
        $latestWeight = $weightLogsAll->last()->weight ?? null;

         $weightDifference = $weightTarget && $latestWeight
        ? $latestWeight - $weightTarget->target_weight
        : null;

    
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

   
        $weightLogs = WeightLog::where('user_id', $userId)
        ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        })
        ->orderBy('date', 'asc')
        ->paginate(8); 
        $resultCount = $weightLogs->total();
        
        return view('admin', compact('weightLogs', 'weightTarget', 'latestWeightOverall', 'weightDifference', 'startDate', 'endDate','resultCount'));
}
        public function show($weightLogId)
        {
           $weightLog = WeightLog::findOrFail($weightLogId);

           return view('detail',compact('weightLog'));
        }

        public function update(Request $request ,$weightLogId)
        {
            $weightLog = WeightLog::findOrFail($weightLogId);
            $weightLog->date = $request->input('date');
            $weightLog->weight = $request->input('weight');$weightLog->calories = $request->input('calories');
            $weightLog->exercise_time = $request->input('exercise_time');
            $weightLog->exercise_content= $request->input('exercise_content');

            $weightLog->save();

            return redirect()->route('weight_logs.index',$weightLog->id);

        }

        public function destroy($weightLogId)
        {
            $weightLog = WeightLog::findOrFail($weightLogId);
            $weightLog->delete();

            return redirect()->route('weight_logs.index');
        }


         public function create()
     {
       
        $weightLog = new WeightLog();
        return view('weight_logs.create'); 
    }

        public function store(Request $request)
    {
        $userId = 1;

        
        $weightLog = new WeightLog();
        $weightLog->user_id = $userId;
        $weightLog->date = $request->input('date');
        $weightLog->weight = $request->input('weight');$weightLog->calories = $request->input('calories');
        $weightLog->exercise_time = $request->input('exercise_time') . ':00';
        $weightLog->exercise_content= $request->input('exercise_content');

        $weightLog->save();
        return redirect()->route('weight_logs.index'); 
    }
}

   