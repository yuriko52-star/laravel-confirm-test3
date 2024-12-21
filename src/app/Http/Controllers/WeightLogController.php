<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use App\Http\Requests\WeightLogRequest;

class WeightLogController extends Controller
{   
    public function showStep1()
    {
        return view('auth.register1');
    }
    public function processStep1(Request $request) {
// バリデーションは別のところに書くけどこれはここでいいのかな
    Session::put('registration', $request->only('name', 'email', 'password'));
    return redirect()->route('register.step2');
    }
     public function showStep2()
    {
        return view('auth.register2');
    }
    
    public function processStep2(WeightLogRequest $request) 
    {
        $validated = $request->validated();
        $registrationData = Session::get('registration');

        $user = User::create([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'password' => bcrypt($registrationData['password']),
            // 'current_weight' => $request->current_weight,
            // 'target_weight' => $request->target_weight,
        ]);
            $user->weightLogs()->create([
        'weight' => $validated['current_weight'],
            ]);
         // current_weightをweight_logsテーブルに保存
        // $user = auth()->user();
        $user->weightTarget()->create([
        'target_weight' => $validated['target_weight'],
        ]);

    // 登録完了後のリダイレクト
        // return redirect('/weight_logs')->with('success', '目標体重が設定されました！');
        
         Session::forget('registration');
        // $user = auth()->user();
        Auth::login($user);

        return redirect('/login');
    }



     public function index()
    {
        
        // ログイン中のユーザーIDを取得fortifyを設定したらこのコードにする
        // $userId = auth()->id();
         $userId = 1; // 表示したいユーザーのIDを指定
          $weightLogs = WeightLog::where('user_id', $userId)->orderBy('date', 'asc')->paginate(8);

        
        $latestWeight = $weightLogs->last()->weight ?? null;

         $latestWeightOverall = WeightLog::where('user_id', $userId)
        ->orderBy('date', 'desc') // 最新の日付で降順ソート
        ->first()->weight ?? null;

        $weightTarget = WeightTarget::where('user_id', $userId)->first();

      
        $weightDifference = $weightTarget && $latestWeightOverall
        ?  $latestWeightOverall - $weightTarget->target_weight
        : null;
       
        
        return view('admin', compact('weightLogs', 'latestWeightOverall', 'weightTarget', 'weightDifference'));
        

        // return view('auth.login');
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

        public function update(WeightLogRequest $request ,$weightLogId)
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

        public function store(WeightLogRequest $request)
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
        public function goalSetting()
    {
         return view('change');
    }

} 