@extends('layouts.app')

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-power icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>@choice('functionalities.account', 1)
                <div class="page-title-subheading">¿Sabías que? Las suricatas tienen una manera curiosa de organizarse en comunidades
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            
        </div>   
    </div>
</div>

@if(Bouncer::is($user)->a('super') || Bouncer::is($user)->a('admin')  || Bouncer::is($user)->a('supervisor') || Bouncer::is($user)->a('reports'))
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{  __('functionalities.account_var.my_user') }}
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                           <a href="{{ route('account.edit', [$user->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="content">
    	                <div class="box box-primary">
    	                    <div class="box-body">
    	                        <div class="row">
    	                            @include('account.user')
    	                        </div>
    	                    </div>
    	                </div>
    	            </div>
                    
                </div>  
            </div>
        </div>
    </div>
@endif

@if(Bouncer::is($user)->a('admin'))
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{  __('functionalities.account_var.my_plan') }}</div>
                <div class="card-body">
                    <div class="content">
    	                <div class="box box-primary">
    	                    <div class="box-body">
    	                        <div class="row">
    	                            @include('account.plan')
    	                        </div>
    	                    </div>
    	                </div>
    	            </div>

                </div>  
            </div>
        </div>
    </div>
@endif

@if(Bouncer::is($user)->a('admin'))
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{  __('functionalities.account_var.associated_users') }}
    				<div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            @if($button_create == false)
                                <a class="btn btn-primary disabled" href="{{ route('associatedUsers.create') }}">{{ __('functionalities.create') }} @choice('functionalities.users', 1)</a> 
                            @else
                                <a class="btn btn-primary" href="{{ route('associatedUsers.create') }}">{{ __('functionalities.create') }} @choice('functionalities.users', 1)</a> 
                            @endif
                        </div>
                    </div>
                </div>

                @if($users->isNotEmpty())
                    <div class="card-body">  
                        @include('flash::message')
                        @include('associated_users.table')
                        {{ $users->links() }}
                    </div>  
                @else
                    @include('states.empty_state')
                @endif
            </div>
        </div>
    </div>
@endif

@endsection