  
<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.front')
<!--titleセクション自分の活動履歴を表示-->
@section('title', '自分の猫活動')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <!--deleteアクションを呼び出すためのURLを、formタグのactionがpostメソッドで取得-->
      <form action="{{ route('activity.historydelete') }}" method="post" enctype="multipart/form-data">
        <div class="col-md-12">
          <h2>自分の猫活動</h2>
          <!--一覧表示-->
          <div class="row">
            <div class="col-md-12">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th width="10%">更新日</th>
                    <th width="10%">タイトル</th>
                    <th width="30%">活動内容</th>              
                    <th width="30%">画像</th>                
                  </tr>
                </thead>
                <!--posts配列のactivityとして受け取ったレコードデータを順に出力していく-->
                <tbody> 
                  @foreach($activity as $a)
                    <tr>
                      <td>{{ $a->updated_at->format('Y年m月d日') }}</td>
                      <!--activityテーブルの入力データに紐づいたuserデータの名前を表示-->
                      <td>{{str_limit($a->title, 20)}}</td>
                      <td>{{str_limit($a->content, 20)}}</td>
                      <td>
                      　<div class="image col-md-6 text-right mt-4">
                             @if ($a->image_path)
                                  <img src="{{ $a->image_path }}">
                             @endif
                        </div>
                      </td>
                      <td>
                        <input type="submit" class="btn btn-primary" value="削除">
                      </td>
                    </tr>
                      <!--非表示のid送信するには、テーブルの外に書く-->
                      <input type="hidden" name="id" value="{{ $a->id }}">
                      {{ csrf_field() }}
                  @endforeach
                </tbody>
              </table>
            </div>
           </div>
        </div>
      </form>
    </div>
  </div>
@endsection


