@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('groups.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
