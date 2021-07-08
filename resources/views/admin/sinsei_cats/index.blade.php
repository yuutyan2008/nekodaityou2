  
<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.admin')
<!--titleセクション猫台帳検索を表示-->
@section('title', '猫台帳検索')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2>新規登録申請中の猫一覧</h2>
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
                @foreach($posts as $sinsei_cat)

                    <tr>
                        <td>{{ $sinsei_cat->updated_at->format('Y年m月d日') }}</td>
                        <td>{{str_limit($sinsei_cat->name, 20)}}</td>
                        <td>{{str_limit($sinsei_cat->tail, 20)}}</td>
                        <td>{{str_limit($sinsei_cat->hair, 20)}}</td>
                        <td>{{str_limit($sinsei_cat->gender, 10)}}</td>
                        <td>{{str_limit($sinsei_cat->area, 20)}}</td>
                        <td>{{str_limit($sinsei_cat->attention, 30)}}</td>
                        <td>{{str_limit($sinsei_cat->remarks, 20)}}</td>
                        @if ($sinsei_cat->image_path)
                          <td><img src="{{ $sinsei_cat->image_path }}">
                        @endif
                        <td>
                          <div>
                              <a href="{{ action('Admin\Sinsei_catController@edit', ['id' => $sinsei_cat->id]) }}">編集</a>
                          </div>  
                        </td>
                        <td>
                          <div>
                              <a href="{{ action('Admin\Sinsei_catController@edit' }}">猫台帳に登録</a>
                          </div>  
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection