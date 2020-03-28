@extends('layouts.app')

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            <div class="content">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row" style="padding-left: 20px">
                            @include('administrator.users.show_fields')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
