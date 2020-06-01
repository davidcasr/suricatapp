@extends('layouts.app')

@section('content')

<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-bell icon-gradient bg-mean-fruit">
                </i>
            </div>
            <div>Notificaciones
                <div class="page-title-subheading">¿Sabías que? Las suricatas tienen una manera curiosa de organizarse en comunidades
                </div>
            </div>
        </div>
        <div class="page-title-actions">
            
        </div>   
    </div>
</div>

 <div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">
                Notificaciones
                @if(count(auth()->user()->unreadNotifications) > 0)
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <a href="{{ url('notifications/markAsRead') }}" class="btn btn-primary">Marcar todo como leído</a>
                        </div>
                    </div> 
                @endif           
            </div>
            <div class="card-body">
                @if(count(auth()->user()->unreadNotifications) > 0)
                    @foreach(auth()->user()->unreadNotifications as $notification)
                        @if($notification->type === 'App\\Notifications\\BirthdayNotification')
                        
                        <div class="card-shadow-primary border mb-2 card card-body border-danger">
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="font-icon-wrapper">
                                        <i class="pe-7s-gift icon-gradient bg-love-kiss"> </i>
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <h5 class="card-title">{{ $notification->data['first_name']. " ". $notification->data['last_name'] }}</h5>
                                    Cumpleaños hoy, dedícale un lindo mensaje
                                </div>
                            </div>
                            
                        </div>
                            
                        @endif
                        @if($notification->type === 'App\\Notifications\\NonAttendanceNotification')
                            <div class="card-shadow-primary border mb-2 card card-body border-danger">
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="font-icon-wrapper">
                                            <i class="pe-7s-less icon-gradient bg-love-kiss"> </i>
                                        </div>
                                    </div>
                                    <div class="col-md-11">
                                        <h5 class="card-title">{{ $notification->data['first_name']. " ". $notification->data['last_name'] }}</h5>
                                        Tiene {{ $notification->data['nonattendance'] }} de inasistencias a reuniones
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach 
                @else
                    @include('states.empty_state')
                @endif
            </div>
        </div>
    </div>
</div>

 <div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">
                Próximos Eventos
            </div>
            <div class="card-body">
                @if($birthdays_nearby->isNotEmpty())
                    @foreach($birthdays_nearby as $person)
                        <div class="card-shadow-primary border mb-2 card card-body border-primary">
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="font-icon-wrapper">
                                        <i class="pe-7s-date icon-gradient bg-plum-plate"> </i>
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <h5 class="card-title">{{ $person->fullName }}</h5>
                                    {{ $person->birth->format('d-M-Y') }} 
                                    / {{ $person->birth->age }} años
                                 </div>
                            </div>   
                            
                        </div> 
                    @endforeach
                @else
                    @include('states.empty_state')
                @endif                  
            </div>   
        </div>
    </div>
</div>

@endsection