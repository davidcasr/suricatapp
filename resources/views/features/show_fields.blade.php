<!-- Name Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('name', __('functionalities.features_var.name')) !!}</b>
    <p>{{ $feature->name }}</p>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('description', __('functionalities.features_var.description')) !!}</b>
    <p>{{ $feature->description }}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b>
    <p>{{ $feature->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b>
    <p>{{ $feature->updated_at }}</p>
</div>

