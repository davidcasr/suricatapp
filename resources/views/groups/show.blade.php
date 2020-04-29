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
@endsection

