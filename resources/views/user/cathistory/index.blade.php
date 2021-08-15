  
<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.front')
<!--titleセクションを表示-->
@section('title', '自分の猫台帳登録履歴')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2>猫一覧</h2>
      </div>
    </div>
  </div>

        <!--一覧表示-->

    <div class="row">
   
      <div class="col-md-12">
        <table class="table table-striped">
          <thead>
              <tr>
                  <th width="5%">クリックして選択</th>
                  <th width="5%">更新日</th>
                  <th width="5%">猫の名前</th>
                  <th width="5%">しっぽの長さ</th>
                  <th width="5%">毛の模様</th>
                  <th width="5%">性別</th>
                  <th width="5%">居住エリア</th>
                  <th width="10%">注意事項</th>
                  <th width="20%">備考欄</th>
                  <th width="30%">画像</th>
                  <th width="10%"></th>
                  
                  
                  
              </tr>
          </thead>
            <!--posts配列catとして受け取ったレコードデータを順に出力していく-->
            <tbody>
                @foreach($cathistory as $cathis)

                    <tr>
                        <td>{{ $cathis->updated_at->format('Y年m月d日') }}</td>
                        <td>{{str_limit($cathis->name, 20)}}</td>
                        <td>{{str_limit($cathis->tail, 20)}}</td>
                        <td>{{str_limit($cathis->hair, 20)}}</td>
                        <td>{{str_limit($cathis->gender, 10)}}</td>
                        <td>{{str_limit($cathis->area, 20)}}</td>
                        <td>{{str_limit($cathis->attention, 30)}}</td>
                        <td>{{str_limit($cathis->remarks, 20)}}</td>
                        @if ($cathis->image_path)
                          <td><img src="{{ $cathis->image_path }}">
                        @endif
                        <td>
                          <div>
                              <a href="{{ action('User\CathisotryController@edit', ['id' => $user->id]) }}">編集</a>
                          </div>                          
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
      </div>
    </div>
@endsection