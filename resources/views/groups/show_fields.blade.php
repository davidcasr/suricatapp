<!-- Parent Id Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('parent_id', __('functionalities.groups_var.parent_id')) !!}</b>
    <p>{{ $group->parent_id }}</p>
</div>

<!-- Identification Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('identification', __('functionalities.groups_var.identification')) !!}</b>
    <p>{{ $group->identification }}</p>
</div>

<!-- Name Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('name', __('functionalities.groups_var.name')) !!}</b>
    <p>{{ $group->name }}</p>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('description', __('functionalities.groups_var.description')) !!}</b>
    <p>{{ $group->description }}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b>
    <p>{{ $group->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b>
    <p>{{ $group->updated_at }}</p>
</div>

