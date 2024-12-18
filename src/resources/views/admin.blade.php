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

              <!-- ここにあたいをうめこむ -->
              <td class="item"><span>?</span>kg
              </td>
              <td class="item"><span>-1.5</span>kg</td>
              <td class="item"><span>??</span>kg</td>
            </tr>
          </table>
        </div>
        <div class="under-table">
          <form action="/weight_logs/search" class="form" method="get">
           <div class="form-group">
              <div class="date-item">
                <!-- ここにも埋め込む -->
                <input type="date" class="date" name="date" value="">
                ~
                <input type="date" class="date" name="date" value="">
              <div class="seach-result">
                <!-- ここにも -->
                  ～の検索結果
                  <label class="result">5件</label>
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
            <tr class="row">
             
              <!-- ここにも -->
              <td class="data-item"></td>
              <td class="data-item">kg</td>
              <td class="data-item"></td>
              <td class="data-item"></td>
              <td class="data-item">
                <a href="" class="">
                  <img src="{{ asset('/images/Group.png') }}" alt="" class="pen-img">
                </a>
              </td>
            </tr>
            
           </table>
           <div class="pagination">
            pegination
           </div>
          </form>
        </div>
      </div>
@endsection