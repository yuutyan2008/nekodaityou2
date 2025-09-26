<!--レイアウトの継承設定。親ファイルディレクトリ名  ファイル名-->
@extends('layouts.front')
<!--titleセクション猫台帳検索を表示-->
@section('title', '猫台帳検索')

@section('content')
@php
$filters = $filters ?? [];
@endphp
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>猫一覧</h2>
    </div>
  </div>

  <!--検索フォーム-->
  <div class="row">
    <div class="col-md-12">
      <form action="{{ action('user\\CatController@index') }}" method="get">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="name">猫の名前</label>
            <input id="name" type="text" class="form-control" name="name" value="{{ $filters['name'] ?? '' }}">
          </div>
          <div class="form-group col-md-4">
            <label for="tail">しっぽの長さ</label>
            <select id="tail" class="custom-select" name="tail">
              <option value="">しっぽの長さを選んでください</option>
              <option value="長い" {{ ($filters['tail'] ?? '') === '長い' ? 'selected' : '' }}>長い</option>
              <option value="短い" {{ ($filters['tail'] ?? '') === '短い' ? 'selected' : '' }}>短い</option>
              <option value="中間くらい" {{ ($filters['tail'] ?? '') === '中間くらい' ? 'selected' : '' }}>中間くらい</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="hair">毛色と模様</label>
            <select id="hair" class="custom-select" name="hair">
              <option value="">毛色と模様を選んでください</option>
              <option value="茶トラ" {{ ($filters['hair'] ?? '') === '茶トラ' ? 'selected' : '' }}>茶トラ</option>
              <option value="茶白" {{ ($filters['hair'] ?? '') === '茶白' ? 'selected' : '' }}>茶白</option>
              <option value="黒" {{ ($filters['hair'] ?? '') === '黒' ? 'selected' : '' }}>黒</option>
              <option value="白黒" {{ ($filters['hair'] ?? '') === '白黒' ? 'selected' : '' }}>白黒</option>
              <option value="キジ白" {{ ($filters['hair'] ?? '') === 'キジ白' ? 'selected' : '' }}>キジ白</option>
              <option value="キジ" {{ ($filters['hair'] ?? '') === 'キジ' ? 'selected' : '' }}>キジ</option>
              <option value="白" {{ ($filters['hair'] ?? '') === '白' ? 'selected' : '' }}>白</option>
              <option value="グレー" {{ ($filters['hair'] ?? '') === 'グレー' ? 'selected' : '' }}>グレー</option>
              <option value="三毛" {{ ($filters['hair'] ?? '') === '三毛' ? 'selected' : '' }}>三毛</option>
              <option value="その他" {{ ($filters['hair'] ?? '') === 'その他' ? 'selected' : '' }}>その他</option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="gender">性別</label>
            <select id="gender" class="custom-select" name="gender">
              <option value="">性別を選んでください</option>
              <option value="オス" {{ ($filters['gender'] ?? '') === 'オス' ? 'selected' : '' }}>オス</option>
              <option value="メス" {{ ($filters['gender'] ?? '') === 'メス' ? 'selected' : '' }}>メス</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="area">居住エリア</label>
            <select id="area" class="custom-select" name="area">
              <option value="">居住エリアを選んでください</option>
              <option value="農獣塔前" {{ ($filters['area'] ?? '') === '農獣塔前' ? 'selected' : '' }}>農獣塔前</option>
              <option value="体育館裏" {{ ($filters['area'] ?? '') === '体育館裏' ? 'selected' : '' }}>体育館裏</option>
              <option value="図書館付近" {{ ($filters['area'] ?? '') === '図書館付近' ? 'selected' : '' }}>図書館付近</option>
              <option value="教育学部塔付近" {{ ($filters['area'] ?? '') === '教育学部塔付近' ? 'selected' : '' }}>教育学部塔付近</option>
              <option value="ビオトープ" {{ ($filters['area'] ?? '') === 'ビオトープ' ? 'selected' : '' }}>ビオトープ</option>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label for="attention">注意事項</label>
            <select id="attention" class="custom-select" name="attention">
              <option value="">注意事項を選んでください</option>
              <option value="避妊去勢済" {{ ($filters['attention'] ?? '') === '避妊去勢済' ? 'selected' : '' }}>避妊去勢済</option>
              <option value="病気の可能性" {{ ($filters['attention'] ?? '') === '病気の可能性' ? 'selected' : '' }}>病気の可能性</option>
              <option value="怪我をしている" {{ ($filters['attention'] ?? '') === '怪我をしている' ? 'selected' : '' }}>怪我をしている</option>
              <option value="妊娠の可能性" {{ ($filters['attention'] ?? '') === '妊娠の可能性' ? 'selected' : '' }}>妊娠の可能性</option>
              <option value="譲渡できそう" {{ ($filters['attention'] ?? '') === '譲渡できそう' ? 'selected' : '' }}>譲渡できそう</option>
            </select>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-12 text-right">
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
            <td>{{ str_limit($cat->name, 20) }}</td>
            <td>{{ str_limit($cat->tail, 20) }}</td>
            <td>{{ str_limit($cat->hair, 20) }}</td>
            <td>{{ str_limit($cat->gender, 10) }}</td>
            <td>{{ str_limit($cat->area, 20) }}</td>
            <td>{{ str_limit($cat->attention, 30) }}</td>
            <td>{{ str_limit($cat->remarks, 20) }}</td>
            <td>
              <div class="image col-md-6 text-right mt-4">
                @if ($cat->image_path)
                <img src="{{ $cat->image_path }}">
                @endif
              </div>
            </td>
          </tr>
          {{ csrf_field() }}
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
