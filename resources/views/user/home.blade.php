@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">選んでください</div>
                    <div class="card-body">
                        <a href="{{ url('user/cats/create') }}">猫台帳の新規作成</a>　
                        <a href="{{ url('user/cats/index') }}">猫台帳一覧と更新</a>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('user/cathistory/index') }}">自分の猫台帳登録履歴</a>
                    </div>
 
                    <div class="card-body">
                        <a href="{{ url('user/activity/index') }}">猫活動TOPページ</a>　
                        <a href="{{ url('user/activityhistory/index') }}">自分の猫活動履歴</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection