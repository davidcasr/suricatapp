<!-- Name Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('name', __('functionalities.profiles_var.name')) !!}</b>
    <p>{{ $profile->name }}</p>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('description', __('functionalities.profiles_var.description')) !!}</b>
    <p>{{ $profile->description }}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('created_at',  __('functionalities.created_at')) !!}</b>
    <p>{{ $profile->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b>
    <p>{{ $profile->updated_at }}</p>
</div>

