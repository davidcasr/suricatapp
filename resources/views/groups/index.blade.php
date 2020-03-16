@extends('layouts.app')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph1 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>@choice('functionalities.groups', 1)
                    <div class="page-title-subheading">¿Sabías que? Las suricatas tienen una manera curiosa de organizarse en comunidades
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <a class="btn btn-primary" href="{{ route('groups.create') }}">{{ __('functionalities.create') }} @choice('functionalities.groups', 1)</a>  
            </div>   
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    @include('flash::message')
                    @include('groups.table')
                    {{ $groups->links() }}
                </div>  
            </div>
        </div>
    </div>
    
@endsection

