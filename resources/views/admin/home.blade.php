@extends('layouts.app_admin') 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">選んでください</div>
                

                <div class="card-body">
                  <button type="button" class="btn btn-link">猫台帳一覧</button>
                  <a href ="https://df3c82739bad4300bc7f886cd182013b.vfs.cloud9.us-east-2.amazonaws.com/admin/cats/index">猫台帳一覧</a>
                </div>
                <div class="card-body">
                  <button type="button" class="btn btn-link">会員情報を参照</button>
                  <a href="https://df3c82739bad4300bc7f886cd182013b.vfs.cloud9.us-east-2.amazonaws.com/admin/user/index">会員情報を参照</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
