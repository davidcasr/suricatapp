<!-- name Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('name', __('functionalities.abilities_var.name')) !!}</b>
    <p>{!! $ability->name !!}</p>
</div>

<!-- title Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('title', __('functionalities.abilities_var.title')) !!}</b>
    <p>{!! $ability->title !!}</p>
</div>

<!-- entity_id Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('entity_id', __('functionalities.abilities_var.entity_id')) !!}</b>
    <p>{!! $ability->entity_id !!}</p>
</div>

<!-- entity_type Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('entity_type', __('functionalities.abilities_var.entity_type')) !!}</b>
    <p>{!! $ability->entity_type !!}</p>
</div>

<!-- options Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('options', __('functionalities.abilities_var.options')) !!}</b>
    <p>
        @foreach($ability->options as $ability)
            {{ $ability }}
        @endforeach
    </p>
</div>

<!-- scope Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('scope', __('functionalities.abilities_var.scope')) !!}</b>
    <p>{!! $ability->scope !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b>
    <p>{!! $ability->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b>
    <p>{!! $ability->updated_at !!}</p>
</div>

