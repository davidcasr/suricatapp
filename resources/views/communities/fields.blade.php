<!-- Identification Field -->
<div class="form-group col-sm-12">
    {!! Form::label('identification', __('functionalities.communities_var.identification')) !!}
    {!! Form::text('identification', null, ['class' => 'form-control','maxlength' => 100]) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', __('functionalities.communities_var.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 250]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('functionalities.communities_var.description')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    {!! Form::label('address', __('functionalities.communities_var.address')) !!}
    {!! Form::text('address', null, ['class' => 'form-control map-input', 'id' => 'address-input']) !!}
</div>

<!-- Latitude Field -->
<div class="form-group col-sm-12">
    <!-- {!! Form::label('latitude', __('functionalities.communities_var.latitude')) !!} -->
    {!! Form::hidden('latitude', 0, ['id' => 'address-latitude']) !!}
</div>

<!-- Longitude Field -->
<div class="form-group col-sm-12">
    <!-- {!! Form::label('longitude', __('functionalities.communities_var.longitude')) !!} -->
    {!! Form::hidden('longitude', 0, ['id' => 'address-longitude']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit( __('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('communities.index') !!}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>


