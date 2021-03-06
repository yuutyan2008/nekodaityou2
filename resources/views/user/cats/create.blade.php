<!--<?php phpinfo(); ?> -->
<!--レイアウトの継承設定。親ファイルディレクトリ名 . ファイル名-->
@extends('layouts.front')
<!--titleセクションに猫台帳の新規作成を表示
@section('title', '猫台帳の新規作成')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h2>猫台帳の新規作成</h2>
            </div>
        </div>
        <!--フォームの送信先を指定-->
        <form action="{{ action('user\CatController@create') }}" method="post" enctype="multipart/form-data">
            <!--$errorはvalidationで弾かれた値の入った配列-->
            @if (count($errors) > 0)
                <ul>
                    <!--$errorsの中身の数だけループし、その中身を$eに代入。-->
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="form row">
                <div class="form-group col-md-5">
                    <label class="col-md-2" for="name">猫の名前</label>
                        <!--old（変数名)は入力エラーで画面が戻された時も自動で入れ直す-->
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="tail">しっぽの長さ</label>
                        <select name="tail" class="custom-select">
                            <option value="" selected>しっぽの長さを選んでください</option>
                            <option value="長い" @if(old('tail')=="長い") selected @endif>長い</option>
                            <option value="短い" @if(old('tail')=="短い") selected @endif>短い</option>
                            <option value="中間くらい" @if(old('tail')=="中間くらい") selected @endif>中間くらい</option>
                        </select>
                </div>
                <div class="form-group col-md-2">
                    <label for="hair">毛色と模様</label>
                        <select name="hair" class="custom-select">
                            <option value="" selected>毛色と模様を選んでください</option>
                            <option value="茶トラ" @if(old('hair')=="茶トラ") selected @endif>茶トラ</option>
                            <option value="茶白" @if(old('hair')=="茶白") selected @endif>茶白</option>
                            <option value="黒" @if(old('hair')=="黒") selected @endif>黒</option>
                            <option value="白黒" @if(old('hair')=="白黒") selected @endif>白黒</option>
                            <option value="キジ白" @if(old('hair')=="キジ白") selected @endif>キジ白</option>
                            <option value="キジ" @if(old('hair')=="茶トラ") selected @endif>茶トラ</option>
                            <option value="白" @if(old('hair')=="白") selected @endif>白</option>
                            <option value="グレー" @if(old('hair')=="グレー") selected @endif>グレー</option>
                            <option value="三毛" @if(old('hair')=="三毛") selected @endif>三毛</option>
                            <option value="その他" @if(old('hair')=="その他") selected @endif>その他</option>
                        </select>
                </div>
                <div class="form-group col-md-1">
                    <label for="gender">性別</label>    
                        <select name="gender" class="custom-select">
                            <option value="" selected>性別を選んでください</option>
                            <option value="オス" @if(old('gender')=="オス") selected @endif>オス</option>
                            <option value="メス" @if(old('gender')=="メス") selected @endif>メス</option>
                        </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="area">居住エリア</label>
                        <select name="area" class="custom-select">
                            <option value="" selected>居住エリアを選んでください</option>
                            <option value="農獣塔前" @if(old('area')=="農獣塔前") selected @endif>農獣塔前</option>
                            <option value="体育館裏" @if(old('area')=="体育館裏") selected @endif>体育館裏</option>
                            <option value="図書館付近" @if(old('area')=="図書館付近") selected @endif>図書館付近</option>
                            <option value="グラウンド付近" @if(old('area')=="グラウンド付近") selected @endif>グラウンド付近</option>
                            <option value="ビオトープ" @if(old('area')=="ビオトープ") selected @endif>ビオトープ</option>
                        </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="attention">注意事項</label>
                        <select name="attention" class="custom-select">
                            <option value="" selected>注意事項を選んでください</option>
                            <option value="避妊去勢済" @if(old('attention')=="避妊去勢済") selected @endif>避妊去勢済</option>
                            <option value="病気の可能性"@if(old('attention')=="病気の可能性") selected @endif>病気の可能性</option>
                            <option value="怪我をしている"@if(old('attention')=="怪我をしている") selected @endif>怪我をしている</option>
                            <option value="妊娠の可能性"@if(old('妊娠の可能性')=="妊娠の可能性") selected @endif>妊娠の可能性</option>
                            <option value="譲渡できそう"@if(old('attention')=="譲渡できそう") selected @endif>譲渡できそう</option>
                        </select>
                </div>
                <div class="form-group col-md-8">
                    <label class="col-md-2" for="remarks">備考欄</label>
                        <!--old（変数名)は入力エラーで画面が戻された時も自動で入れ直す-->
                        <input type="text" class="form-control" name="remarks" value="{{ old('remarks') }}">
                </div>
            </div>
                <div class="form-group row">
                    <label class="col-md-4" for="image">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image" value="{{ old('image') }}">
                        </div>
                </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="作成">
        </form>
    </div>
@endsection