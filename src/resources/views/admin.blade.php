@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" >
@endsection

@section('content')
<div class="all-tables">
        <div class="top-table">
          <table>
             
            <tr class="row">
              <th class="label">目標体重</th>
              <th class="label">目標まで</th>
              <th class="label">最新体重</th>
            </tr>
             
            <tr class="row">

              
              <td class="item"><span class="weight">{{ $weightTarget->target_weight }}</span>kg
              </td>
              

              <td class="item"><span class="weight">{{ $weightDifference }}</span>kg</td>
              

              <td class="item"><span class="weight">{{ $latestWeightOverall }}</span>kg</td>
              
            </tr>
           
          </table>
        </div>
        <div class="under-table">
          <form action="/weight_logs/search" class="form" method="get">
           <div class="form-group">
              <div class="date-item">
               
                
                <input type="date" class="date" name="start_date" value="{{old('start_date', $startDate ?? '')}}">
                ~
                
                <input type="date" class="date" name="end_date" value="{{old('end_date',$endDate ?? '' ) }}">
              <div class="seach-result">
                
                 @if(isset($startDate) && isset($endDate))
                  {{ $startDate }}～{{ $endDate }}の検索結果
                  <label class="result">{{$resultCount}}件</label>
                  @endif
                </div>
              </div>
              <div class="search-form__actions">
                <input class="search-form__search-btn btn" type="submit" value="検索">
                <input class="search-form__reset-btn btn" type="submit" value="リセット" name="reset">
                <input type="submit" class="add-btn btn" value="データ追加">
              </div>
            </div>
           <table>
            <colgroup>
              <col style="width: 300px;">
              <col style="width: 200px;">
              <col style="width: 260px;">
              <col style="width: 200px;">
              <col style="width: 100px;">
            </colgroup>
            <tr class="under-table-row">
              <th class="data-label">日付</th>
              <th class="data-label">体重</th>
              <th class="data-label">摂取カロリー</th>
              <th class="data-label">運動時間</th>
              <th class="data-label"> </th>
            </tr>
             @foreach ($weightLogs as $log)
            <tr class="row">
             <td class="data-item">{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
              <td class="data-item">{{$log->weight}} kg</td>
              <td class="data-item">{{$log->calories}} cal</td>
             <td class="data-item">{{ \Carbon\Carbon::parse($log->exercise_time)->format('H:i') }}</td>
              <td class="data-item">
               
                <a href="{{ route('weight_logs.show',['weightLogId'=>$log->id]) }}" class="">
                  <img src="{{ asset('/images/Group.png') }}" alt="" class="pen-img">
                </a>
              </td>
            </tr>
            @endforeach

           </table>
           <div class="pagination-content">
            {{$weightLogs->appends(request()->query())->links('pagination::bootstrap-4')}}
           </div>
          </form>
        </div>
      </div>

      <style>
    table {
    width: 100%;
    border-collapse: collapse;
  }

 
  table tr {
    transition: background-color 0.3s ease;
  }

  
  table tr:hover {
    background-color: #f0f8ff; 
    cursor: pointer; 
  }
  </style>
@endsection