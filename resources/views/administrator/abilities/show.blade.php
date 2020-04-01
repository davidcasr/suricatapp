@extends('layouts.app')

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @include('administrator.abilities.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection


