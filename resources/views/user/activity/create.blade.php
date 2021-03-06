  
<!--レイアウトの継承設定。親ファイルディレクトリ名 . ファイル名-->
@extends('layouts.front')
<!--titleセクションに猫台帳の新規作成を表示
@section('title', '地域猫活動の投稿')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>猫活動の投稿</h2>
            </div>
        </div>
        <div class="row">
　　        <div class="col-md-4">
            <!--フォームの送信先を指定-->
            <form action="{{ route('activity.create') }}" method="post" enctype="multipart/form-data">
    
            <!--エラーの数だけ$eに入れて$eを表示-->
            @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            @endif
            </div>
            <div class="form-group row">
                <label class="col-md-2" for="title">タイトル</label>
                <div class="col-md-10">
                    <!--old（変数名)は入力エラーで画面が戻された時も自動で入れ直す-->
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2" for="content">活動内容</label>
                <div class="col-md-10">
                    <textarea class="form-control" name="content" rows="20">{{ old('content') }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2" for="image">画像</label>
                <div class="col-md-10">
                    <input type="file" class="form-control-file" name="image" value="{{ old('image_path') }}">
                </div>
            </div>
            {{ csrf_field() }}
            <input type="submit" class="btn btn-primary" value="投稿">
            </form>
            </div>
        </div>

    </div>

@endsection