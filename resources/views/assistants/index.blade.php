@extends('layouts.app')

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-map-2 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>@choice('functionalities.assistants', 1)
                    <div class="page-title-subheading">
                        {{ __('messages.what_is_assitant') }}
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                {{--
                  <a class="btn btn-primary" href="{{ route('assistants.create') }}">{{ __('functionalities.create') }} @choice('functionalities.assistants', 1)</a> 
                --}} 
            </div>   
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            @if($assistants->isNotEmpty())
                <div class="main-card mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                            
                        </div>
                        <div class="btn-actions-pane-right">
                            {!! Form::open([
                              'method' => 'GET',
                              'url' => 'assistants',
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
                        @include('assistants.table')
                        {{ $assistants->appends(['search' => Request::get('search')])->links() }}
                    </div>  
                </div>
            @else
                @include('states.empty_state')
            @endif
        </div>
    </div>
    
@endsection

