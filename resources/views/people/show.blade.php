@extends('layouts.app')

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @include('people.show_fields')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Grupos y perfiles
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <a class="btn btn-primary" href="{{ route('communityPeople.create', ['person' => $person->id ]) }}">Asignar grupo y perfil</a>  
                        </div>
                    </div>
                </div>

                @if($community_people->isNotEmpty())
                    <div class="card-body">  
                        @include('flash::message')
                        @include('people.table_groups_and_profiles')
                        {{ $community_people->links() }}
                    </div>  
                @else
                    @include('states.empty_state')
                @endif
            </div>
        </div>
    </div>
@endsection

