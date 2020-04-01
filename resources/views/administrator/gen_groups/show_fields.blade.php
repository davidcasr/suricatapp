<div class="table-responsive table-striped">
    <table class="table">
        <tbody>
            <!-- Group Cod Field -->
            <tr>
                <td><b>{!! Form::label('group_cod',  __('functionalities.gen_groups_var.group_cod')) !!} </b></td>
                <td>{!! $genGroup->group_cod !!}</td>
            </tr>
            <!-- Group Description Field -->
            <tr>
                <td> <b>{!! Form::label('group_description',  __('functionalities.gen_groups_var.group_description')) !!} </b></td>
                <td>{!! $genGroup->group_description !!}</td>
            </tr>
            <!-- Enabled Field -->
            <tr>
                <td><b>{!! Form::label('enabled',  __('functionalities.gen_groups_var.enabled')) !!} </b></td>
                <td>{!! $genGroup->enabled !!}</td>
            </tr>
            <!-- Created At Field -->
            <tr>
                <td><b>{!! Form::label('created_at', __('functionalities.created_at')) !!} </b></td>
                <td>{!! $genGroup->created_at !!}</td>
            </tr>
            <!-- Updated At Field -->
            <tr>
                <td><b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!} </b></td>
                <td>{!! $genGroup->updated_at !!}</td>
            </tr>

        </tbody>        
    </table>
</div>