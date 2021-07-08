  
<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.front')
<!--titleセクション活動内容を表示-->
@section('title', '活動内容')

@section('content')
  <div class="container-fluid">
    @if (!is_null($headline))
      <div class="row">
        <div class="headline col-md-10 mx-auto">
          <div class="row">
            <div class="col-md-6">
              <div class="image">
                  <!--image_pathには保存した画像のファイル名が入り、assetはファイルのパスを返している。（画像のパスを返す）-->
                  @if ($headline->image_path)
                      <img src="{{ asset('storage/image/' . $headline->image_path) }}">
                  @endif
              </div>
              <div class="col-md-6">
                <p>{{ str_limit($headline->updated_at->format('Y年m月d日'), 70) }}</p>
              </div>
              <div class="title">
                <h1>{{ str_limit($headline->title, 70) }}</h1>
              </div>
              <div class="name">
                <p>{{ str_limit($headline->user->name, 70) }}</p>
              </div>
              <div class="content">
                <p class="body mx-auto">{{ str_limit($headline->content, 650) }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif

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
                                      <img src="{{ asset('storage/image/' . $activity->image_path) }}">
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