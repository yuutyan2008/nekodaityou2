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
                        <a href="{{ url('user/cats/cathistoryindex') }}">自分の猫台帳</a>
                    </div>
 
                    <div class="card-body">
                        <a href="{{ url('user/activity/index') }}">猫活動TOPページ</a>　
                        <a href="{{ url('user/activity/create') }}">自分の猫活動新規作成</a>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('user/activityhistory/index') }}">自分の猫活動</a>
                    </div>
                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection