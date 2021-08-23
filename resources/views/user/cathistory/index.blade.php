  
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
      <form action="{{ route('cathistory.index') }}" method="get" enctype="multipart/form-data">         
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
                @foreach($cathistory as $c)
                  <tr>
                    <td>{{ $c->updated_at->format('Y年m月d日') }}</td>
                    <td>{{str_limit($c->name, 20)}}</td>
                    <td>{{str_limit($c->tail, 20)}}</td>
                    <td>{{str_limit($c->hair, 20)}}</td>
                    <td>{{str_limit($c->gender, 10)}}</td>
                    <td>{{str_limit($c->area, 20)}}</td>
                    <td>{{str_limit($c->attention, 30)}}</td>
                    <td>{{str_limit($c->remarks, 20)}}</td>
                    @if ($c->image_path)
                      <td><img src="{{ $c->image_path }}">
                    @endif
                    <td>
                      <div>
                        <a href ="/user/cathistory/index, ['id' => $c->id]) }}">編集</a>
                      </div>                          
                    </td>
                  </tr>
                @endforeach
              </tbody>
          </table>
        </div>
      </form>
    </div>
@endsection