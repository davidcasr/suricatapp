{{--  
    <!-- User Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('user_id', __('functionalities.meeting_reports_var.user_id')) !!}
        {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Person Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('person_id', __('functionalities.meeting_reports_var.person_id')) !!}
        {!! Form::text('person_id', null, ['class' => 'form-control']) !!}
    </div>
--}}
@if($meetings != null)
    <!-- Meeting Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('meeting_id', __('functionalities.meeting_reports_var.meeting_id')) !!}
        {!! Form::select('meeting_id',$meetings, null, ['class' => 'form-control']) !!}
    </div>
@endif

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('functionalities.meeting_reports_var.description')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control ckeditor']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('meetingReports.index') }}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>

@section('scripts')
   <script>
        $(document).ready(function () {
           $('#meeting_id').select2({
               width: '100%'
           });
        });     
    </script>
@endsection
