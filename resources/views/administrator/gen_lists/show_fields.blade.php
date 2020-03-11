<!-- Item Id Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('item_id', __('functionalities.gen_lists_var.item_id')) !!} </b>
    <p>{!! $genList->item_id !!}</p>
</div>

<!-- Item Description Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('item_description', __('functionalities.gen_lists_var.item_description')) !!} </b>
    <p>{!! $genList->item_description !!}</p>
</div>

<!-- Item Cod Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('item_cod', __('functionalities.gen_lists_var.item_cod')) !!} </b>
    <p>{!! $genList->item_cod !!}</p>
</div>

<!-- Enabled Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('enabled', __('functionalities.gen_lists_var.enabled')) !!} </b>
    <p>{!! $genList->enabled !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('created_at', __('functionalities.created_at')) !!} </b>
    <p>{!! $genList->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!} </b>
    <p>{!! $genList->updated_at !!}</p>
</div>

