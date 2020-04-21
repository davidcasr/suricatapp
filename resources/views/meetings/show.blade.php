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
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{  __('functionalities.assistants_var.guests') }}
                    <div class="btn-actions-pane-right">

                    </div>
                </div>

                @if($assistants->isNotEmpty())
                    <div class="card-body">  
                        @include('flash::message')
                        @include('assistants.table')
                        {{ $assistants->links() }}
                    </div>  
                @else
                    @include('states.empty_state')
                @endif
            </div>
        </div>
    </div>

    
@endsection
