@extends('layouts.app')

@section('content')
<div class="main-card card">
        <div class="card-body">
         <div class="content">
             @include('adminlte-templates::common.errors')
             <div class="box box-primary">
                 <div class="box-body">
                     <div class="row">
                         {!! Form::model($meetingReport, ['route' => ['meetingReports.update', $meetingReport->id], 'method' => 'patch']) !!}

                             @include('meeting_reports.fields')

                        {!! Form::close() !!}
                     </div>
                 </div>
             </div>
         </div>
   </div>
</div>
@endsection

