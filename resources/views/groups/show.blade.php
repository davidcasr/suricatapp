@extends('layouts.app')

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @include('groups.show_fields')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        {{ __('functionalities.dashboard_var.assitantsPerMonth') }}
                    </div>
                </div>
                <div class="card-body">
                    {{ $assitantsPerMonthFilterGroup->container() }}
                </div>
            </div>            
        </div>

        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        {{ __('functionalities.dashboard_var.assistantsPerMeeting') }}  [Mes {{ \Carbon\Carbon::now()->format('m') }}]
                    </div>
                </div>
                <div class="card-body">
                    {{ $assistantsPerMeetingFilterGroup->container() }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">@choice('functionalities.people', 2)
                    <div class="btn-actions-pane-right">

                    </div>
                </div>

                @if($people->isNotEmpty())
                    <div class="card-body">  
                        @include('flash::message')
                        @include('groups.table_people')
                        {{ $people->links() }}
                    </div>  
                @else
                    @include('states.empty_state')
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">@choice('functionalities.meetings', 2)
                    <div class="btn-actions-pane-right">

                    </div>
                </div>

                @if($meetings->isNotEmpty())
                    <div class="card-body">  
                        @include('flash::message')
                        @include('groups.table_meetings')
                        {{ $meetings->links() }}
                    </div>  
                @else
                    @include('states.empty_state')
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {!! $assitantsPerMonthFilterGroup->script() !!}
    {!! $assistantsPerMeetingFilterGroup->script() !!}
@endsection
