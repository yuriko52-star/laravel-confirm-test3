@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/change.css') }}">
@endsection

@section('content')
<div class="main-content">
        <h1>目標体重設定</h1>
        <form action="{{ route('goal.setting')}}" class="change-form" method="post">
            @csrf
           
            <input type="text" class="input" name="target_weight"value="{{old('target_weight',$weightTarget->target_weight ??'' )}}"><span class="kg">kg</span>
            
            <div class="button-content">
                <a href="/weight_logs" class="back">戻る</a>
                <button type="submit" class="button-update">更新</button>
            </div>
        </form>
</div>
@endsection