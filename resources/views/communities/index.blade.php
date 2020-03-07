@extends('layouts.app')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>@choice('functionalities.communities', 1)
                    <div class="page-title-subheading">¿Sabías que? Las suricatas tienen una manera curiosa de organirzarse en comunidades
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <a class="btn btn-primary pull-right" href="{{ route('communities.create') }}">{{ __('functionalities.create') }} @choice('functionalities.communities', 1)</a>
                
            </div>   
        </div>
    </div>
    
    <div class="main-card card">
        <div class="card-body">
            <div class="content">
                <div class="clearfix"></div>

                @include('flash::message')

                <div class="clearfix"></div>
                <div class="box box-primary">
                    <div class="box-body">
                        @include('communities.table')
                    </div>
                </div>
                <div class="text-center">
                
                </div>
            </div>
        </div>
    </div>
    
@endsection

