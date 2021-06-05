  
<!--レイアウトの継承設定。親ファイルディレクトリ名 . ファイル名-->
@extends('layouts.admin')
<!--titleセクションに猫台帳の新規作成を表示
@section('title', '猫台帳の新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>猫台帳の新規作成</h2>
            </div>
        </div>
    </div>
    
    <div class="row">
　　　<div class="col-md-4">
        <!--フォームの送信先を指定-->
        <form action="{{ action('user\CatController@create') }}" method="post" enctype="multipart/form-data">

        <!--エラーの数だけ$eに入れて$eを表示-->
        @if (count($errors) > 0)
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        @endif
        <div class="form-group row">
            <label class="col-md-2" for="name">猫の名前</label>
            <div class="col-md-10">
                <!--old（変数名)は入力エラーで画面が戻された時も自動で入れ直す-->
                <input type="text" class="form-control" name="nema" value="{{ old('name') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2" for="title">画像</label>
            <div class="col-md-10">
                <input type="file" class="form-control-file" name="image">
            </div>
        </div>
        {{ csrf_field() }}
        <input type="submit" class="btn btn-primary" value="更新">
    </form>

@endsection