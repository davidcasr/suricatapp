<!-- Group Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('group_id', __('functionalities.gen_lists_var.group_id')) !!}
    @if(isset($user))
        <br>
        {!! Form::select('group_id', $gen_group, old('group_id'), ['class' => 'form-control', 'required' => 'required']) !!}
    @else
        {!! Form::select('group_id', $gen_group, null, ['class' => 'form-control', 'required' => 'required']) !!}
    @endif
</div>

<!-- Item Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('item_id', __('functionalities.gen_lists_var.item_id')) !!}
    {!! Form::text('item_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Item Description Field -->
<div class="form-group col-sm-12">
    {!! Form::label('item_description', __('functionalities.gen_lists_var.item_description')) !!}
    {!! Form::text('item_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Item Cod Field -->
<div class="form-group col-sm-12">
    {!! Form::label('item_cod', __('functionalities.gen_lists_var.item_cod')) !!}
    {!! Form::text('item_cod', null, ['class' => 'form-control']) !!}
</div>

<!-- Enabled Field -->
<div class="form-group col-sm-12">
    {!! Form::label('enabled', __('functionalities.gen_lists_var.enabled')) !!}
    {!! Form::selectRange('enabled', 0, 1, 1, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit( __('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('genLists.index') !!}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>