@extends('layouts.app')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph1 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>@choice('functionalities.profiles', 1)
                    <div class="page-title-subheading">
                        {{ __('messages.what_is_profile') }}
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                <a class="btn btn-primary" href="{{ route('profiles.create') }}">{{ __('functionalities.create') }} @choice('functionalities.profiles', 1)</a>  
            </div>   
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            @if($profiles->isNotEmpty())
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        @include('flash::message')
                        @include('profiles.table')
                        {{ $profiles->links() }}
                    </div>  
                </div>
            @else
                @include('states.empty_state')
            @endif
        </div>
    </div>
    
@endsection



