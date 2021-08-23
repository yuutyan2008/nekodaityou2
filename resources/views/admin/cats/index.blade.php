  
<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.admin')
<!--titleセクション猫台帳検索を表示-->
@section('title', '猫台帳検索')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h2>猫一覧</h2>
      </div>
    </div>
  </div>
　　<!--検索フォーム-->
  <div class="row">
    <div class="col-md-12">
      <!--フォームの送信先を指定-->
      <form action="{{ action('Admin\CatController@edit') }}" method="post" enctype="multipart/form-data">
          <div class="form row">
            <div class="form-group col-md-6">
            　<label class="col-md-2">猫の名前</label>
              　<div class="col-md-5">
              　　<input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
            　　</div>
          　</div>        
          <div class="form-row">
            <div class="form-group col-md-5">
              <label for="tail">しっぽの長さ</label>
                  <select class="custom-select">
                      <option selected>しっぽの長さを選んでください</option>
                      <option value="長い">長い</option>
                      <option value="短い">短い</option>
                      <option value="中間くらい">中間くらい</option>
                  </select>

          </div>
          <div class="form-group col-md-5">
              <label for="hair">毛の模様</label>

                  <select class="custom-select">
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
          <div class="form-group col-md-2">
              <label for="gender">性別</label>

                  <select class="custom-select">
                      <option selected>性別を選んでください</option>
                      <option value="オス">オス</option>
                      <option value="メス">メス</option>
                  </select>

          </div>
          <div class="form-group row">
            <div class="form-group col-md-6">
              <label for="area">居住エリア</label>

                  <select class="custom-select">
                      <option selected>居住エリアを選んでください</option>
                      <option value="農獣塔前">農獣塔前</option>
                      <option value="体育館裏">体育館裏</option>
                      <option value="図書館付近">図書館付近</option>
                      <option value="教育学部塔付近">教育学部塔付近</option>
                      <option value="ビオトープ">ビオトープ</option>
                  </select>

          </div>
          <div class="form-group col-md-6">
              <label for="attention">注意事項</label>
                  <select class="custom-select">
                      <option selected>注意事項を選んでください</option>
                      <option value="避妊去勢済">避妊去勢済</option>
                      <option value="病気の可能性">病気の可能性</option>
                      <option value="怪我をしている">怪我をしている</option>
                      <option value="妊娠の可能性">妊娠の可能性</option>
                      <option value="譲渡できそう">譲渡できそう</option>
                  </select>
          </div>
        　<div class="form row">
    　　　　　　　<div class="col-md-5">
              <button type="submit" class="btn btn-primary">検索</button>
            </div>
          </div>
      </form>
    </div>
  </div>
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
            <!--posts配列catとして受け取ったレコードデータを順に出力していく-->
            <tbody>
                @foreach($posts as $cat)

                    <tr>
                        <td>{{ $cat->updated_at->format('Y年m月d日') }}</td>
                        <td>{{str_limit($cat->name, 20)}}</td>
                        <td>{{str_limit($cat->tail, 20)}}</td>
                        <td>{{str_limit($cat->hair, 20)}}</td>
                        <td>{{str_limit($cat->gender, 10)}}</td>
                        <td>{{str_limit($cat->area, 20)}}</td>
                        <td>{{str_limit($cat->attention, 30)}}</td>
                        <td>{{str_limit($cat->remarks, 20)}}</td>
                        @if ($cat->image_path)
                          <td><img src="{{ $cat->image_path }}">
                        @endif
                        <td>
                          <div>
                              <a href="https://df3c82739bad4300bc7f886cd182013b.vfs.cloud9.us-east-2.amazonaws.com/admin/cats/index, ['id' => $cat->id])">編集</a>
                          </div>  
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection