@extends('layouts.app_admin') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">選んでください</div>
                <div class="card-body">
                  <a href ="/admin/cats/index">猫台帳一覧</a>
                </div>
                <div class="card-body">
                 
                  <a href="/admin/user/index">会員情報を参照</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
