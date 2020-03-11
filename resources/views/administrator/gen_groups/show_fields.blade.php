<!-- Group Cod Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('group_cod',  __('functionalities.gen_groups_var.group_cod')) !!} </b>
    <p>{!! $genGroup->group_cod !!}</p>
</div>

<!-- Group Description Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('group_description',  __('functionalities.gen_groups_var.group_description')) !!} </b>
    <p>{!! $genGroup->group_description !!}</p>
</div>

<!-- Enabled Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('enabled',  __('functionalities.gen_groups_var.enabled')) !!} </b>
    <p>{!! $genGroup->enabled !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('created_at', __('functionalities.created_at')) !!} </b>
    <p>{!! $genGroup->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!} </b>
    <p>{!! $genGroup->updated_at !!}</p>
</div>

