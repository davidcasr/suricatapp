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
                    <div class="page-title-subheading">
                        {{ __('messages.what_is_community') }}
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
            @include('flash::message')
            @if($communities->isNotEmpty())
                <div class="main-card mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                            
                        </div>
                        <div class="btn-actions-pane-right">
                            {!! Form::open([
                              'method' => 'GET',
                              'url' => 'communities',
                              'role' => 'search'
                            ])!!}

                            <div role="group" class="btn-group-sm btn-group">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="search" placeholder="{{ __('functionalities.search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-dark" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div class="card-body">
                        @include('flash::message')
                        @include('communities.table')
                        {{ $communities->appends(['search' => Request::get('search')])->links() }}
                    </div>  
                </div>
            @else
                @include('states.empty_state')
            @endif
        </div>
    </div>
    
@endsection

