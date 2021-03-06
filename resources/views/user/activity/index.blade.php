  
<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.front')
<!--titleセクション活動内容を表示-->
@section('title', '活動内容')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2>地域猫活動の投稿一覧</h2>
      </div>
    </div>
      <!--一覧表示-->
      <div class="row">
        <div class="col-md-12">
          <!--indexアクションを呼び出すためのURLを、formタグのactionがgetメソッドで取得-->
          
            <table class="table table-striped">
              <thead>
                <tr>
                    <th width="5%">更新日</th>
                    <th width="5%">投稿者</th>
                    <th width="5%">タイトル</th>
                    <th width="30%">活動内容</th>              
                    <th width="30%">画像</th>                
                </tr>
              </thead>
                <!--posts配列のactivityとして受け取ったレコードデータを順に出力していく-->
                <tbody> 
                    @foreach($posts as $activity)
                      <tr>
                          <td>{{ $activity->updated_at->format('Y年m月d日') }}</td>
                          <!--activityテーブルの入力データに紐づいたuserデータの名前を表示-->
                          <td>{{str_limit($activity->user->name, 20)}}</td>
                          <td>{{str_limit($activity->title, 20)}}</td>
                          <td>{{str_limit($activity->content, 20)}}</td>
                          <td>
                            <div class="image col-md-6 text-right mt-4">
                               @if ($activity->image_path)
                                    <img src="{{ $activity->image_path }}">
                               @endif
                            </div>
                          </td>
                      </tr>
                    @endforeach
                </tbody>
            </table>   
          </div>
        </div>
      </div>
  </div>
@endsection