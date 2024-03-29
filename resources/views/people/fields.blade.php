@if($communities != null)
<!-- Communities Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('communities', 'Comunidad') !!}
        {!! Form::select('communities[]', $communities, null, ['class' => 'form-control','multiple' => 'multiple', 'id' => 'communities']) !!} 
    </div>
@endif

<!-- Identification Field -->
<div class="form-group col-sm-12">
    {!! Form::label('identification', __('functionalities.people_var.identification')) !!}
    {!! Form::text('identification', null, ['class' => 'form-control']) !!}
</div>

<!-- First Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('first_name', __('functionalities.people_var.first_name')) !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('last_name', __('functionalities.people_var.last_name')) !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-12">
    {!! Form::label('email', __('functionalities.people_var.email')) !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

@if($sexes != null)
    <!-- Sex Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('sex', __('functionalities.people_var.sex')) !!}
        {!! Form::select('sex',$sexes, null, ['class' => 'form-control']) !!}
    </div>
@endif

<!-- Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('address', __('functionalities.people_var.address')) !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

@if(isset($person))
    <!-- Birth Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('birth', __('functionalities.people_var.birth')) !!}
        {!! Form::date('birth', $person->birth, ['class' => 'form-control','id'=>'birth']) !!}
    </div>
@else
    <!-- Birth Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('birth', __('functionalities.people_var.birth')) !!}
        {!! Form::date('birth', \Carbon\Carbon::now(), ['class' => 'form-control','id'=>'birth']) !!}
    </div>
@endif

<!-- City Field -->
<div class="form-group col-sm-12">
    {!! Form::label('city', __('functionalities.people_var.city')) !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

@if($countries != null)
    <!-- Country Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('country', __('functionalities.people_var.country')) !!}
        {!! Form::select('country', $countries, null, ['class' => 'form-control','id' => 'country']) !!}
    </div>
@endif

<!-- Phone Field -->
<div class="form-group col-sm-12">
    {!! Form::label('phone', __('functionalities.people_var.phone')) !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

{{--
    <!-- Photo Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('photo', __('functionalities.people_var.photo')) !!}
        {!! Form::text('photo', null, ['class' => 'form-control']) !!}
    </div>
--}}

<!-- features Field -->
<div class="form-group col-sm-12">
    {!! Form::label('features', trans_choice('functionalities.features', 2)) !!}
    {!! Form::select('features[]', $features, null, ['class' => 'form-control', 'multiple' => 'multiple', 'id' => 'features']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('people.index') }}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>

@section('scripts')
   <script>
        $(document).ready(function () {
           $('#communities').select2({
               width: '100%',
           });

           $('#features').select2({
               width: '100%',
           });

           $('#country').select2({
               width: '100%',
           });
        });     
    </script>
@endsection