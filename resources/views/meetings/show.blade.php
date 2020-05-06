@extends('layouts.app')

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @include('meetings.show_fields')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @include('meetings.statistics_assistants')
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{  __('functionalities.assistants_var.guests') }}
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <a class="btn btn-primary" href="{{ route('guests.create',  ['meeting' => $meeting->id]) }}">{{ __('functionalities.create') }} Nuevo @choice('functionalities.assistants', 1) </a>  
                        </div>
                    </div>
                </div>

                @if($assistants->isNotEmpty())
                    <div class="card-body">  
                        @include('flash::message')
                        @include('meetings.table_assitants')
                        {{ $assistants->links() }}
                    </div>  
                @else
                    @include('states.empty_state')
                @endif
            </div>
        </div>
    </div>

    
@endsection
