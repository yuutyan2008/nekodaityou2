  
<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.front')
<!--titleセクション自分の活動履歴を表示-->
@section('title', '自分の猫活動')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <!--indexアクションを呼び出すためのURLを、formタグのactionがgetメソッドで取得-->
      <form action="{{ route('activityhistory.index') }}" method="get" enctype="multipart/form-data">
        <div class="col-md-12">
          <h2>自分の猫活動</h2>
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
        <div class="row">
          <div class="col-md-12">
            <h2>自分の猫活動</h2>
          </div>
        </div>
          <!--一覧表示-->
          <div class="row">
            <div class="col-md-12">
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
                  @foreach($activityhistory as $a)
                    <tr>
                      <td>{{ $a->updated_at->format('Y年m月d日') }}</td>
                      <!--activityhistoryテーブルの入力データに紐づいたuserデータの名前を表示-->
                      <td>{{str_limit($a->user->name, 20)}}</td>
                      <td>{{str_limit($a->title, 20)}}</td>
                      <td>{{str_limit($a->content, 20)}}</td>
                      <td>
                        <div class="image col-md-6 text-right mt-4">
                           @if ($a->image_path)
                            <!--ファイルの場所と、ファイル名を結合-->
                            <img src="{{ asset('storage/image/' . $a->image_path) }}">
                           @endif
                        </div>
                      </td>
                      <td>
                        <div>
                          <a href ="{{ route('activityhistory.edit', ['id' => $a->id]) }}">編集</a>
                        </div>                          
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>   
            </div>
          </div>
        </form>
    </div>
  </div>
@endsection


