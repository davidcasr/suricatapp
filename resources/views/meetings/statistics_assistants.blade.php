<div class="col-md-6 col-xl-4">
    <div class="card mb-3 widget-content">
        <div class="widget-content-outer">
            <div class="widget-content-wrapper">
                <div class="widget-content-left">
                    <div class="widget-heading">Asistentes</div>
                    <div class="widget-subheading">Total de asistentes</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-primary">{{ $statistics_assitants }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-xl-4">
    <div class="card mb-3 widget-content">
        <div class="widget-content-outer">
            <div class="widget-content-wrapper">
                <div class="widget-content-left">
                    <div class="widget-heading">Nuevos</div>
                    <div class="widget-subheading">Total de nuevos asistentes</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-warning">{{ $statistics_new_assitants }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6 col-xl-4">
    <div class="card mb-3 widget-content">
        <div class="widget-content-outer">
            <div class="widget-content-wrapper">
                <div class="widget-content-left">
                    <div class="widget-heading">No asistieron</div>
                    <div class="widget-subheading">Personas que no asistieron</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-danger">{{ $statistics_no_assitants }}</div>
                </div>
            </div>
        </div>
    </div>
</div>