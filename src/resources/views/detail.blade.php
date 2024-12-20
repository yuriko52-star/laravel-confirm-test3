@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="main-content">
            <h1>Weight Log</h1>
           
            <form action="{{ route('weight_logs.update',$weightLog->id) }}" class="detail-form" method="post">
              @method('put')
              @csrf
                    <label class="label">日付<span>必須</span></label>
                    <input type="date" class="date" name="date"value="{{old('date' ,$weightLog->date)}}">
                
                <p class="error">日付を選択してね</p>
                
                <label for="" class="label">体重<span>必須</span></label>
                <input type="text" class="input"name="weight" value="{{old('weight',$weightLog->weight)}}">kg
                <p class="error">体重を入力してね</p>
                <label for="" class="label">摂取カロリー<span>必須</span></label>
                <input type="text" class="input"name="calories" value="{{old('calories',$weightLog->calories)}}">cal
                <p class="error">摂取カロリーを入力してね</p>
                <label for="" class="label">運動時間<span>必須</span></label>
                <input type="text" name="exercise_time"class="input"value="{{ \Carbon\Carbon::parse($weightLog->exercise_time)->format('H:i') }}">
                <p class="error">運動時間を入力してね</p>
                <label for="" class="label">運動内容
                </label>
                <textarea name="exercise_content" class="textarea">{{ old('exercise_content',$weightLog->exercise_content)}}</textarea>
                <p class="error">運動内容を入力してね</p>

                <div class="button-content">
                    <a href="/weight_logs" class="back">戻る</a>
                    <input type="submit" class="button-update"value="更新">
                </div>
            </form>
            <form action="{{ route('weight_logs.delete', $weightLog->id) }}" class="delete" method="post">
                @method('delete')
                @csrf
                <button type="submit"class="trash-can-content"><img src="{{ asset('/images/ゴミ箱のアイコン素材 1 (1).png') }}" alt="" class="img-trash-can" />
                </button>
            </form>
            
                        
                            
</div>

@endsection