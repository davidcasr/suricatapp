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
                    <div class="page-title-subheading">¿Sabías que? Las suricatas tienen una manera curiosa de organizarse en comunidades
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                @if($button_create == false)
                    <a class="btn btn-primary disabled" href="{{ route('communities.create') }}">{{ __('functionalities.create') }} @choice('functionalities.communities', 1)</a>  
                @else
                    <a class="btn btn-primary" href="{{ route('communities.create') }}">{{ __('functionalities.create') }} @choice('functionalities.communities', 1)</a>
                @endif
            </div>   
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            @if($communities->isNotEmpty())
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        @include('flash::message')
                        @include('communities.table')
                        {{ $communities->links() }}
                    </div>  
                </div>
            @else
                @include('states.empty_state')
            @endif
        </div>
    </div>
    
@endsection

