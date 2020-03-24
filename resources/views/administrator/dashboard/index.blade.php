@extends('layouts.app')

@section('content')

	<div class="row">
	    <div class="col-md-6 col-xl-3">
	        <div class="card mb-3 widget-content bg-happy-green">
	            <div class="widget-content-wrapper text-white">
	                <div class="widget-content-left">
	                    <div class="widget-heading">Comunidades</div>
	                    <div class="widget-subheading">Registradas</div>
	                </div>
	                <div class="widget-content-right">
	                    <div class="widget-numbers text-white"><span>{{ $communities }}</span></div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="col-md-6 col-xl-3">
	        <div class="card mb-3 widget-content bg-sunny-morning">
	            <div class="widget-content-wrapper text-white">
	                <div class="widget-content-left">
	                    <div class="widget-heading">Personas</div>
	                    <div class="widget-subheading">Registradas</div>
	                </div>
	                <div class="widget-content-right">
	                    <div class="widget-numbers text-white"><span>{{ $people }}</span></div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="col-md-6 col-xl-3">
	        <div class="card mb-3 widget-content bg-mixed-hopes">
	            <div class="widget-content-wrapper text-white">
	                <div class="widget-content-left">
	                    <div class="widget-heading">Grupos</div>
	                    <div class="widget-subheading">Registrados</div>
	                </div>
	                <div class="widget-content-right">
	                    <div class="widget-numbers text-white"><span>{{ $groups }}</span></div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="col-md-6 col-xl-3">
	        <div class="card mb-3 widget-content bg-night-sky">
	            <div class="widget-content-wrapper text-white">
	                <div class="widget-content-left">
	                    <div class="widget-heading">Reuniones</div>
	                    <div class="widget-subheading">Registradas</div>
	                </div>
	                <div class="widget-content-right">
	                    <div class="widget-numbers text-white"><span>{{ $meetings }}</span></div>
	                </div>
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
                        Usuarios por mes
                    </div>
                </div>
                <div class="card-body">
                    {{ $peoplePerMonth->container() }}
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
                <div class="card-header-tab card-header-tab-animation card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                        Reuniones por mes
                    </div>
                </div>
                <div class="card-body">
                    {{ $meetingsPerMonth->container() }}
                </div>
            </div>
        </div>     
    </div>

@endsection

@section('scripts')
	{!! $peoplePerMonth->script() !!}
	{!! $meetingsPerMonth->script() !!}
@endsection