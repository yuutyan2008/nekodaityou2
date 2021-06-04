  
<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.admin')
<!--titleセクション猫台帳検索を表示-->
@section('title', '猫台帳検索')

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
        <div class="col-md-12">
          <table class="table table-striped">
            <thead>
              <tr>
                  <th width="5%">更新日</th>
                  <th width="5%">投稿者</th>
                  <th width="5%">活動内容</th>              
                  <th width="30%">画像</th>                
              </tr>
          </thead>
            <!--posts配列catとして受け取ったレコードデータを順に出力していく-->
            <tbody> 
                @foreach($posts as $activity)
                  <tr>
                      <td>{{ $activity->updated_at->format('Y年m月d日') }}</td>
                      <td>{{str_limit($activity->user_id, 20)}}</td>
                      <td>{{str_limit($activity->content, 20)}}</td>
                      @if ($activity->image_path)
                        <td><img src="{{ $activity->image_path }}">
                      @endif
                  </tr>
                @endforeach
            </tbody>
        </div>
      </div>
    </div>
  </div>
@endsection