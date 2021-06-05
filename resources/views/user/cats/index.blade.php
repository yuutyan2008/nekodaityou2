  
<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.admin')
<!--titleセクション猫台帳検索を表示-->
@section('title', '猫台帳検索')

@section('content')

<header style="background-color:gray">猫台帳検索</header>
<div class="container">
    <div class="row">
        <h2>猫一覧</h2>
    </div>
    <!--検索フォーム-->
    <div class="row">
　　　<div class="col-md-4">
　　　   <!--indexアクションを呼び出すためのURLを、formタグのactionがgetメソッドで取得-->
         <form action="{{ action('user\CatController@index') }}" method="get">
            <div class="form-group row">
              <label class="col-md-2">猫の名前</label>
              <!--入力-->
              <div class="col-md-5">
                <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
              </div>
              <div class="col-md-5">
                <button type="submit" class="btn btn-primary ">検索</button>
              </div>
            </div>
         </form>
      </div>
    </div>
    <!--一覧表示-->
    <div class="row">
      <div class="col-md-12 mx-auto">
        <div class="row">
          <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">猫の名前</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $cat)
                    <tr>
                        <td>{{ $cat->id }}</td>
                        <td>{{ \Str::limit($cat->name, 100) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        </div>
    </div>
@endsection