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

<!-- Sex Field -->
<div class="form-group col-sm-12">
    {!! Form::label('sex', __('functionalities.people_var.sex')) !!}
    {!! Form::text('sex', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('address', __('functionalities.people_var.address')) !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Birth Field -->
<div class="form-group col-sm-12">
    {!! Form::label('birth', __('functionalities.people_var.birth')) !!}
    {!! Form::date('birth', null, ['class' => 'form-control','id'=>'birth']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#birth').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: false
        })
    </script>
@endpush

<!-- City Field -->
<div class="form-group col-sm-12">
    {!! Form::label('city', __('functionalities.people_var.city')) !!}
    {!! Form::text('city', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group col-sm-12">
    {!! Form::label('country', __('functionalities.people_var.country')) !!}
    {!! Form::text('country', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-12">
    {!! Form::label('phone', __('functionalities.people_var.phone')) !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Photo Field -->
<div class="form-group col-sm-12">
    {!! Form::label('photo', __('functionalities.people_var.photo')) !!}
    {!! Form::text('photo', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('people.index') }}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>