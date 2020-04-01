<div class="table-responsive table-striped">
    <table class="table">
        <tbody>
            <!-- Item Id Field -->
            <tr>
                <td><b>{!! Form::label('item_id', __('functionalities.gen_lists_var.item_id')) !!} </b></td>
                <td>{!! $genList->item_id !!}</td>
            </tr>
            <!-- Item Description Field -->
            <tr>
                <td><b>{!! Form::label('item_description', __('functionalities.gen_lists_var.item_description')) !!} </b></td>
                <td>{!! $genList->item_description !!}</td>
            </tr>
            <!-- Item Cod Field -->
            <tr>
                <td><b>{!! Form::label('item_cod', __('functionalities.gen_lists_var.item_cod')) !!} </b></td>
                <td>{!! $genList->item_cod !!}</td>
            </tr>
            <!-- Enabled Field -->
            <tr>
                <td><b>{!! Form::label('enabled', __('functionalities.gen_lists_var.enabled')) !!} </b></td>
                <td>{!! $genList->enabled !!}</td>
            </tr>
            <!-- Created At Field -->
            <tr>
                <td><b>{!! Form::label('created_at', __('functionalities.created_at')) !!} </b></td>
                <td>{!! $genList->created_at !!}</td>
            </tr>
            <!-- Updated At Field -->
            <tr>
                <td><b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!} </b></td>
                <td>{!! $genList->updated_at !!}</td>
            </tr>
        </tbody>        
    </table>
</div>