  
<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.app_admin')
<!--titleセクション会員一覧を表示-->
@section('title', '会員一覧の編集')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2>会員一覧の編集</h2>
        <!--フォームの送信先を指定-->
        <form action="{{ action('Admin\UserController@update') }}" method="post" enctype="multipart/form-data">
          <!--$errors~validationで弾かれた内容が記憶された配列~の数があるなら-->
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
          <div class="form-group row">
              <label class="col-md-2" for="title">名前</label>
              <div class="col-md-10">
                  <input type="text" class="form-control" name="name" value="{{ $user_form->name }}">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-2" for="title">所属</label>
              <div class="col-md-10">
                  <input type="text" class="form-control" name="belonging" value="{{ $user_form->belonging }}">
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-2" for="title">メールアドレス</label>
              <div class="col-md-10">
                  <input type="text" class="form-control" name="email" value="{{ $user_form->email }}">
              </div>
          </div> 
          <div class="form-group row">
            <div class="col-md-10">
                <input type="hidden" name="id" value="{{ $user_form->id }}">
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="更新">
            </div>
         </div>
        </form>
      </div>
    </div>
  </div>
@endsection
