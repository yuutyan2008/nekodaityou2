  
<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.app_admin')
<!--titleセクション会員一覧を表示-->
@section('title', '会員一覧')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2>会員一覧</h2>
      </div>
    </div>
  </div>
　　

        <!--一覧表示-->

    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped">
          <thead>
              <tr>
                  <th width="20%">更新日</th>
                  <th width="20%">名前</th>
                  <th width="30%">所属</th>
                  <th width="30%">メールアドレス</th>
              </tr>
          </thead>
            <!--posts配列userとして受け取ったレコードデータを順に出力していく-->
            <tbody>
                @foreach($posts as $user)
                    <tr>
                        <td>{{ $user->updated_at->format('Y年m月d日') }}</td>
                        <td>{{str_limit($user->name, 20)}}</td>
                        <td>{{str_limit($user->belonging, 20)}}</td>
                        <td>{{str_limit($user->email, 20)}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
