<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', __('functionalities.feature_var.name')) !!}
    <p>{{ $feature->name }}</p>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('description', __('functionalities.feature_var.description')) !!}
    <p>{{ $feature->description }}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
    {!! Form::label('created_at', __('functionalities.created_at')) !!}
    <p>{{ $feature->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
    {!! Form::label('updated_at', __('functionalities.updated_at')) !!}
    <p>{{ $feature->updated_at }}</p>
</div>

