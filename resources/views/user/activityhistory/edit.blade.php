  
<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.front')
<!--titleセクション猫台帳編集画面を表示-->
@section('title', '猫活動履歴の編集')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2>猫活動履歴の編集</h2>
        <!--routing：activityhistory.editにリクエストを送る-->
        <form action= "{{ action('ActivityhistoryController@edit') }}" method="get" enctype="multipart/form-data">
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
                  <option value ="長い" @if($cat_form->tail=== '長い') selected='selected' @endif>長い</option>
                  <option value ="短い" @if($cat_form->tail=== '短い') selected='selected' @endif>短い</option>
                  <option value ="中間くらい" @if($cat_form->tail=== '中間くらい') selected='selected' @endif>中間くらい</option>
                </select>
          </div>
          <div class="form-group row">
              <label class="col-md-2" for="hair">毛の模様</label>
                <select name="tail" class="custom-select">
                  <option value ="茶トラ" @if($cat_form->hair=== '茶トラ') selected='selected' @endif>茶トラ</option>
                  <option value ="茶白" @if($cat_form->hair=== '茶白') selected='selected' @endif>茶白</option>
                  <option value ="黒" @if($cat_form->hair=== '黒') selected='selected' @endif>黒</option>
                  <option value ="白黒" @if($cat_form->hair=== '白黒') selected='selected' @endif>白黒</option>
                  <option value ="キジ白" @if($cat_form->hair=== 'キジ白') selected='selected' @endif>キジ白</option>
                  <option value ="キジ" @if($cat_form->hair=== 'キジ') selected='selected' @endif>キジ</option>
                  <option value ="白" @if($cat_form->hair=== '白') selected='selected' @endif>白</option>
                  <option value ="グレー" @if($cat_form->hair=== 'グレー') selected='selected' @endif>グレー</option>
                  <option value ="三毛" @if($cat_form->hair=== '三毛') selected='selected' @endif>三毛</option>
                  <option value ="その他" @if($cat_form->hair=== 'その他') selected='selected' @endif>その他</option>
                </select>
          </div> 
          <div class="form-group row">
              <label class="col-md-2" for="gender">性別</label>
                <select name="gender" class="custom-select">
                  <option value ="オス" @if($cat_form->gender=== 'オス') selected='selected' @endif>オス</option>
                  <option value ="メス" @if($cat_form->gender=== 'メス') selected='selected' @endif>メス</option>
                </select>
          </div>
          <div class="form-group row">
              <label class="col-md-2" for="area">居住エリア</label>
                <select name="area" class="custom-select">
                  <option value ="農獣塔前" @if($cat_form->area=== '農獣塔前') selected='selected' @endif>農獣塔前</option>
                  <option value ="体育館裏" @if($cat_form->area=== '体育館裏') selected='selected' @endif>体育館裏</option>
                  <option value ="図書館付近" @if($cat_form->area=== '図書館付近') selected='selected' @endif>図書館付近</option>
                  <option value ="教育学部塔付近" @if($cat_form->area=== '教育学部塔付近') selected='selected' @endif>教育学部塔付近</option>
                  <option value ="ビオトープ" @if($cat_form->area=== 'ビオトープ') selected='selected' @endif>ビオトープ</option>
                </select>
            </div> 
          <div class="form-group row">
              <label class="col-md-2" for="attention">注意事項</label>
                <select name="attention" class="custom-select">
                  <option value ="避妊去勢済" @if($cat_form->attention=== '避妊去勢済') selected='selected' @endif>避妊去勢済</option>
                  <option value ="病気の可能性" @if($cat_form->attention=== '病気の可能性') selected='selected' @endif>病気の可能性</option>
                  <option value ="怪我をしている" @if($cat_form->attention=== '怪我をしている') selected='selected' @endif>怪我をしている</option>
                  <option value ="妊娠の可能性" @if($cat_form->attention=== '妊娠の可能性') selected='selected' @endif>妊娠の可能性</option>
                  <option value ="譲渡できそう" @if($cat_form->attention=== '譲渡できそう') selected='selected' @endif>譲渡できそう</option>
                </select>
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