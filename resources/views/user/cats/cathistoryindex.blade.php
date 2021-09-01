  
<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.front')
<!--titleセクション猫台帳編集画面を表示-->
@section('title', '自分の猫台帳')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2>自分の猫台帳</h2>
        <!--フォームの送信先を指定-->
        <form action="{{ route('cats.cathistoryindex') }}"  method="get" enctype="multipart/form-data">
          <!--$errors~validationで弾かれた内容が記憶された配列~の数があるなら-->
          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
          <!--一覧表示-->
          <div class="row">
            <div class="col-md-12">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th width="5%">クリックして選択</th>
                    <th width="5%">更新日</th>
                    <th width="5%">猫の名前</th>
                    <th width="5%">しっぽの長さ</th>
                    <th width="5%">毛の模様</th>
                    <th width="5%">性別</th>
                    <th width="5%">居住エリア</th>
                    <th width="10%">注意事項</th>
                    <th width="20%">備考欄</th>
                    <th width="30%">画像</th>
                    <th width="10%"></th>
                  </tr>
                </thead>
                  <!--cats配列catとして受け取ったレコードデータを順に出力していく-->
                  <tbody>
                      @foreach($cat as $c)
      
                          <tr>
                              <td>{{ $c->updated_at->format('Y年m月d日') }}</td>
                              <td>{{str_limit($c->name, 20)}}</td>
                              <td>{{str_limit($c->tail, 20)}}</td>
                              <td>{{str_limit($c->hair, 20)}}</td>
                              <td>{{str_limit($c->gender, 10)}}</td>
                              <td>{{str_limit($c->area, 20)}}</td>
                              <td>{{str_limit($c->attention, 30)}}</td>
                              <td>{{str_limit($c->remarks, 20)}}</td>
                              @if ($c->image_path)
                                <td><img src="{{ $c->image_path }}">
                              @endif
                              <td>
                                <div>
                                    <a href="{{ route('cats.cathistoryedit', ['id' => $c->id]) }}">編集</a>
                                </div>  
                              </td>
                          </tr>
      
                      @endforeach
                  </tbody>
              </table>
            </div>
          </div>
        </form>
    　</div> 
    </div>
　</div>
@endsection