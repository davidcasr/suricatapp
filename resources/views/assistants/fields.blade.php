@if($meetings != null)
    <!-- Meeting Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('meeting_id', __('functionalities.assistants_var.meeting_id')) !!}
        {!! Form::select('meeting_id', $meetings, null, ['class' => 'form-control']) !!}
    </div>
@endif

@if($people != null)
    <!-- Person Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('person_id', __('functionalities.assistants_var.person_id')) !!}
        {!! Form::select('person_id', $people, null, ['class' => 'form-control']) !!}
    </div>
@endif

<!-- Confirmation Field -->
<div class="form-group col-sm-12">
    {!! Form::label('confirmation', __('functionalities.assistants_var.confirmation')) !!}
    {!! Form::select('confirmation', array(1 => 'Si', 0 => 'No'), 0, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('assistants.index') }}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>

@section('scripts')
   <script>
        $(document).ready(function () {
           $('#person_id').select2({
               width: '100%'
           });

           $('#meeting_id').select2({
               width: '100%'
           });
        });     
    </script>
@endsection
