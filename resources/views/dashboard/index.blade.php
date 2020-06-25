@extends('layouts.app')

@section('content')
	
	@if(!is_null($statisticsInLine))
		<div class="row">
			<div class="col-md-6 col-xl-3">
				<div class="card mb-3 widget-content bg-happy-green">
					<div class="widget-content-wrapper text-white">
						<div class="widget-content-left">
							<div class="widget-heading">Comunidades</div>
							<div class="widget-subheading">#colonias</div>
						</div>
						<div class="widget-content-right">
							<div class="widget-numbers text-white"><span>{{ $statisticsInLine['communities'] }}</span></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-xl-3">
				<div class="card mb-3 widget-content bg-sunny-morning">
					<div class="widget-content-wrapper text-white">
						<div class="widget-content-left">
							<div class="widget-heading">Personas</div>
							<div class="widget-subheading">#suricatas</div>
						</div>
						<div class="widget-content-right">
							<div class="widget-numbers text-white"><span>{{ $statisticsInLine['people'] }}</span></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-xl-3">
				<div class="card mb-3 widget-content bg-mixed-hopes">
					<div class="widget-content-wrapper text-white">
						<div class="widget-content-left">
							<div class="widget-heading">Grupos y subgrupos</div>
							<div class="widget-subheading">#familias</div>
						</div>
						<div class="widget-content-right">
							<div class="widget-numbers text-white"><span>{{ $statisticsInLine['groups'] }}</span></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-xl-3">
				<div class="card mb-3 widget-content bg-night-sky">
					<div class="widget-content-wrapper text-white">
						<div class="widget-content-left">
							<div class="widget-heading">Reuniones</div>
							<div class="widget-subheading">#cazando</div>
						</div>
						<div class="widget-content-right">
							<div class="widget-numbers text-white"><span>{{ $statisticsInLine['meetings'] }}</span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif

	<div class="row">
        <div class="col-md-12 col-lg-6">
			@if(!is_null($peoplePerMonth))
				<div class="mb-3 card">
						<div class="card-header">
							{{ __('functionalities.dashboard_var.peoplePerMonth') }}
						</div>
					<div class="card-body">
						{{ $peoplePerMonth->container() }}
					</div>
				</div>
			@endif
			
			@if(!is_null($assitantsPerMonth))
				<div class="mb-3 card">
						<div class="card-header">
							
							{{ __('functionalities.dashboard_var.assitantsPerMonth') }}
							<div class="btn-actions-pane-right">
								<div role="group" class="btn-group-sm btn-group">
									<a href="{{ url('dashboard/detail/assitantsPerMonth') }}" class="btn btn-primary">Detalle</a>
								</div>
							</div>
						</div>
					
					<div class="card-body">
						{{ $assitantsPerMonth->container() }}
					</div>
				</div>
			@endif
        </div>

        <div class="col-md-12 col-lg-6">
			@if(!is_null($meetingsPerMonth))
				<div class="mb-3 card">
						<div class="card-header">
							{{ __('functionalities.dashboard_var.meetingsPerMonth') }}                     
						</div>
					<div class="card-body">
						{{ $meetingsPerMonth->container() }}
					</div>
				</div>
			@endif

			@if(!is_null($assistantsPerMeeting))
				<div class="main-card mb-3 card">
						<div class="card-header">
							{{ __('functionalities.dashboard_var.assistantsPerMeeting') }}  [Mes {{ \Carbon\Carbon::now()->format('m') }}]
							<div class="btn-actions-pane-right">
								<div role="group" class="btn-group-sm btn-group">
									<a href="{{ url('dashboard/detail/assistantsPerMeeting') }}" class="btn btn-primary">Detalle</a>
								</div>
							</div>
						</div>
					
					<div class="card-body">
						{{ $assistantsPerMeeting->container() }}
					</div>
				</div>
			@endif

        </div>     
    </div>
@endsection

@section('scripts')
	@if(!is_null($peoplePerMonth))
		{!! $peoplePerMonth->script() !!}
	@endif
	
	@if(!is_null($meetingsPerMonth))
		{!! $meetingsPerMonth->script() !!}
	@endif

	@if(!is_null($assitantsPerMonth))
		{!! $assitantsPerMonth->script() !!}
	@endif

	@if(!is_null($assistantsPerMeeting))
		{!! $assistantsPerMeeting->script() !!}
	@endif
@endsection
