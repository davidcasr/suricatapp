@extends('layouts.app')

@section('content')
	
	<div class="row">
	    <div class="col-md-12">
	        @include('flash::message')
	        @if($data->isNotEmpty())
	            <div class="main-card mb-3 card">
	                <div class="card-header-tab card-header-tab-animation card-header">
	                    <div class="card-header-title">
	                        @if($title == 'assitantsPerMonth')
	                    		{{ __('functionalities.dashboard_var.assitantsPerMonth') }}
	                    	@elseif($title == 'assistantsPerMeeting')
	                    		{{ __('functionalities.dashboard_var.assistantsPerMeeting') }}  [Mes {{ \Carbon\Carbon::now()->format('m') }}]
	                    	@endif
	                    </div>
	                </div>

	                <div class="card-body">
	                    @include('flash::message')
	                    @if($title == 'assitantsPerMonth')
	                    	@include('dashboard.table_detail.assitantsPerMonth')
	                    @elseif($title == 'assistantsPerMeeting')
	                    	@include('dashboard.table_detail.assistantsPerMeeting')
	                    @endif
	                </div>  
	            </div>
	        @else
	            @include('states.empty_state')
	        @endif
	    </div>
	</div>	

@endsection