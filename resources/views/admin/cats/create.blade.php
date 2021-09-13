  
<!--レイアウトの継承設定。親ファイルディレクトリ名 . ファイル名-->
@extends('layouts.admin')
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
    <form action="{{ action('Admin\CatController@create') }}" method="post" enctype="multipart/form-data">
        <!--エラーの数だけ$eに入れて$eを表示-->
        @if (count($errors) > 0)
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        @endif

        <div class="form row">
            <div class="col-md-12">
            </div>
        </div>
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
                        <option selected>しっぽの長さを選んでください</option>
                        <option value="長い">長い</option>
                        <option value="短い">短い</option>
                        <option value="中間くらい">中間くらい</option>
                    </select>
            
            </div>
            <div class="form-group col-md-2">
                <label for="hair">毛の模様</label>
                    <select name="hair" class="custom-select">
                        <option selected>毛の模様を選んでください</option>
                        <option value="茶トラ">茶トラ</option>
                        <option value="茶白">茶白</option>
                        <option value="黒">黒</option>
                        <option value="白黒">白黒</option>
                        <option value="キジ白">キジ白</option>
                        <option value="キジ">キジ</option>
                        <option value="白">白</option>
                        <option value="グレー">グレー</option>
                        <option value="三毛">三毛</option>
                        <option value="その他">その他</option>
                    </select>
            </div>
            <div class="form-group col-md-1">
                <label for="gender">性別</label>    
                    <select name="gender" class="custom-select">
                        <option selected>性別を選んでください</option>
                        <option value="オス">オス</option>
                        <option value="メス">メス</option>
                    </select>
            </div>


          <div class="form-group col-md-4">
            <label for="area">居住エリア</label>
                <select name="area" class="custom-select">
                    <option selected>居住エリアを選んでください</option>
                    <option value="農獣塔前">農獣塔前</option>
                    <option value="体育館裏">体育館裏</option>
                    <option value="図書館付近">図書館付近</option>
                    <option value="教育学部塔付近">教育学部塔付近</option>
                    <option value="ビオトープ">ビオトープ</option>
                </select>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="attention">注意事項</label>
                    <select name="attention" class="custom-select">
                        <option selected>注意事項を選んでください</option>
                        <option value="避妊去勢済">避妊去勢済</option>
                        <option value="病気の可能性">病気の可能性</option>
                        <option value="怪我をしている">怪我をしている</option>
                        <option value="妊娠の可能性">妊娠の可能性</option>
                        <option value="譲渡できそう">譲渡できそう</option>
                    </select>
            </div>
            <div class="form-group col-md-8">
                <label class="col-md-2" for="remarks">備考欄</label>
                  <!--old（変数名)は入力エラーで画面が戻された時も自動で入れ直す-->
                <input type="text" class="form-control" name="remarks" value="{{ old('remarks') }}">
            </div>
        </div>
            <div class="form-group row">
                <label class="col-md-4" for="image_path">画像</label>
                <div class="col-md-10">
                    <input type="file" class="form-control-file" name="image_path">
                </div>
            </div>
        {{ csrf_field() }}
        <input type="submit" class="btn btn-primary" value="作成">
    </form>
    </div>

@endsection