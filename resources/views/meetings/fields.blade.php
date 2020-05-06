@if($communities != null)
<!-- Communities Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('communities', 'Comunidad') !!}
        {!! Form::select('communities[]', $communities, null, ['class' => 'form-control','multiple' => 'multiple', 'id' => 'communities']) !!} 
    </div>
@endif

{{--
    <!-- User Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('user_id', __('functionalities.meetings_var.user_id')) !!}
        {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Person Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('person_id', __('functionalities.meetings_var.person_id')) !!}
        {!! Form::text('person_id', null, ['class' => 'form-control']) !!}
    </div>
--}}

<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', __('functionalities.meetings_var.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('functionalities.meetings_var.description')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control ckeditor','maxlength' => 250]) !!}
</div>

@if(isset($meeting))
    <!-- Date Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('date', __('functionalities.meetings_var.date')) !!}
        {!! Form::date('date', $meeting->date, ['class' => 'form-control','id'=>'date']) !!}
    </div>
@else
    <!-- Date Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('date', __('functionalities.meetings_var.date')) !!}
        {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control','id'=>'date']) !!}
    </div>
@endif

@if(isset($meeting))
    <!-- Time Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('time', __('functionalities.meetings_var.time')) !!}
        {!! Form::time('time', $meeting->time, ['class' => 'form-control','id'=>'time']) !!}
    </div>
@else
    <!-- Time Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('time', __('functionalities.meetings_var.time')) !!}
        {!! Form::time('time', null, ['class' => 'form-control','id'=>'time']) !!}
    </div>
@endif

<!-- Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('address', __('functionalities.meetings_var.address')) !!}
    {!! Form::text('address', null, ['class' => 'form-control','maxlength' => 100]) !!}
</div>

{{--  
    <!-- Latitude Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('latitude', __('functionalities.meetings_var.latitude')) !!}
        {!! Form::text('latitude', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Longitude Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('longitude', __('functionalities.meetings_var.longitude')) !!}
        {!! Form::text('longitude', null, ['class' => 'form-control']) !!}
    </div>
--}}

<!-- Assistants Field -->
<div class="form-group col-sm-12">
    {!! Form::label('people', 'Invitados (Individual)') !!}
    {!! Form::select('people[]', $people, null, ['class' => 'form-control','multiple' => 'multiple', 'id' => 'people']) !!} 
</div>

<!-- AssistantsPerGroups Field -->
<div class="form-group col-sm-12">
    {!! Form::label('groups', 'Invitados (Por grupos)') !!}
    {!! Form::select('groups[]', $groups, null, ['class' => 'form-control','multiple' => 'multiple', 'id' => 'groups']) !!} 
    <small><b>Al incluir un grupo invitarás a todas las personas que pertenezcan a este </b></small>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('meetings.index') }}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>

@section('scripts')
   <script>
        $(document).ready(function () {
           $('#communities').select2({
               width: '100%',
           });
        });

        $(document).ready(function () {
           $('#people').select2({
               width: '100%',
           });
        });

        $(document).ready(function () {
           $('#groups').select2({
               width: '100%',
           });
        });        
    </script>
@endsection