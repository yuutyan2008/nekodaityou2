  
<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.admin')
<!--titleセクション猫台帳編集画面を表示-->
@section('title', '猫台帳の編集')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2>猫台帳の編集</h2>
        <!--フォームの送信先を指定-->
        <form action="{{ action('Admin\CatController@update') }}" method="post" enctype="multipart/form-data">
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
              <div class="col-md-10">
                  <input type="text" class="form-control" name="name" value="{{ $cat_form->name }}">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-2" for="tail">しっぽの長さ</label>
                <select name="tail" class="custom-select">
                    <option selected>しっぽの長さを選んでください</option>
                    <option value="長い">長い</option>
                    <option value="短い">短い</option>
                    <option value="中間くらい">中間くらい</option>
                </select>
              <div class="col-md-10">
                  <input type="text" class="form-control" name="tail" value="{{ $cat_form->tail }}">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-2" for="hair">毛の模様</label>
              <div class="col-md-10">
                  <input type="text" class="form-control" name="hair" value="{{ $cat_form->hair }}">
              </div>
          </div> 
          <div class="form-group row">
              <label class="col-md-2" for="gender">性別</label>
              <div class="col-md-10">
                  <input type="text" class="form-control" name="gender" value="{{ $cat_form->gender }}">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-2" for="area">居住エリア</label>
              <div class="col-md-10">
                  <input type="text" class="form-control" name="area" value="{{ $cat_form->area }}">
              </div>
          </div> 
          <div class="form-group row">
              <label class="col-md-2" for="attention">注意事項</label>
              <div class="col-md-10">
                  <input type="text" class="form-control" name="attention" value="{{ $cat_form->attention }}">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-2" for="remarks">備考欄</label>
              <div class="col-md-10">
                  <input type="text" class="form-control" name="remarks" value="{{ $cat_form->remarks }}">
              </div>
          </div> 
          
          <div class="form-group row">
            <div class="col-md-10">
                <input type="hidden" name="id" value="{{ $cat_form->id }}">
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="更新">
            </div>
         </div>
        </form>
      </div>
    </div>
  </div>
@endsection