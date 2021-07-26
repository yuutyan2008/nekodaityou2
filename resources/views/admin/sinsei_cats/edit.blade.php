  
<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.admin')
<!--titleセクション猫台帳編集画面を表示-->
@section('title', '猫台帳の編集')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2>申請猫台帳の編集</h2>
        <!--フォームの送信先を指定-->
        <form action="{{ action('Admin\Sinsei_catController@update') }}" method="post" enctype="multipart/form-data">
          <!--$errors~validationで弾かれた内容が記憶された配列~の数があるなら-->
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
          <div class="form-group row">
              <label class="col-md-2" for="title">猫の名前</label>
              <div class="col-md-3">
                  <input type="text" class="form-control" name="name" value="{{ $sinsei_cat_form->name }}">
              </div>
          </div>  
          <div class="form-group row">
              <label class="col-md-2" for="tail">しっぽの長さ</label>
                <select name="tail" class="custom-select">
                    <option selected>しっぽの長さを選んでください</option>
                    <!--selectタグのname属性の値をoldの引数に指定し、データの値と一致する場合表示-->
                    <option value="長い" @if(old("tail")=="長い") @endif>長い</option>
                    <option value="短い" @if(old("tail")=="短い") @endif>短い</option>
                    <option value="中間くらい" @if(old("tail")=="中間くらい") @endif>中間くらい</option>
                </select>

          </div>
          <div class="form-group row">
              <label class="col-md-2" for="hair">毛の模様</label>
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
              <div class="col-md-10">
                  <input type="text" class="form-control" name="hair" value="{{ $sinsei_cat_form->hair }}">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-2" for="gender">性別</label>
                <select name="gender" class="custom-select">
                    <option selected>性別を選んでください</option>
                    <option value="オス">オス</option>
                    <option value="メス">メス</option>
                </select>   
              <div class="col-md-10">
                  <input type="text" class="form-control" name="gender" value="{{ $sinsei_cat_form->gender }}">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-2" for="area">居住エリア</label>
                <select class="custom-select">
                    <option selected>居住エリアを選んでください</option>
                    <option value="農獣塔前">農獣塔前</option>
                    <option value="体育館裏">体育館裏</option>
                    <option value="図書館付近">図書館付近</option>
                    <option value="教育学部塔付近">教育学部塔付近</option>
                    <option value="ビオトープ">ビオトープ</option>
                </select>
              <div class="col-md-10">
                  <input type="text" class="form-control" name="area" value="{{ $sinsei_cat_form->area }}">
              </div>
          </div> 
          <div class="form-group row">
              <label class="col-md-2" for="attention">注意事項</label>
               <select class="custom-select">
                    <option selected>注意事項を選んでください</option>
                    <option value="避妊去勢済">避妊去勢済</option>
                    <option value="病気の可能性">病気の可能性</option>
                    <option value="怪我をしている">怪我をしている</option>
                    <option value="妊娠の可能性">妊娠の可能性</option>
                    <option value="譲渡できそう">譲渡できそう</option>
                </select>
              <div class="col-md-10">
                  <input type="text" class="form-control" name="attention" value="{{ $sinsei_cat_form->attention }}">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-2" for="remarks">備考欄</label>
              <div class="col-md-10">
                  <input type="text" class="form-control" name="remarks" value="{{ $sinsei_cat_form->remarks }}">
              </div>
          </div> 
          
          <div class="form-group row">
            <div class="col-md-10">
                <input type="hidden" name="id" value="{{ $sinsei_cat_form->id }}">
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="更新">
            </div>
         </div>
        </form>
      </div>
    </div>
  </div>
@endsection