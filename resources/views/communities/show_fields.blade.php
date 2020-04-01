<div class="table-responsive table-striped">
    <table class="table">
        <tbody>
            <!-- Identification Field -->
            <tr>
                <td><b>{!! Form::label('identification', __('functionalities.communities_var.identification')) !!}</b></td>
                <td>{!! $community->identification !!}</td>
            </tr>
            <!-- Name Field -->
            <tr>
                <td><b>{!! Form::label('name', __('functionalities.communities_var.name')) !!}</b></td>
                <td>{!! $community->name !!}</td>
            </tr>
            <!-- Description Field -->
            <tr>
                <td><b>{!! Form::label('description', __('functionalities.communities_var.description')) !!}</b></td>
                <td>{!! $community->description !!}</td>
            </tr>
            <!-- Address Field -->
            <tr>
                <td><b>{!! Form::label('address', __('functionalities.communities_var.address')) !!}</b></td>
                <td>{!! $community->address !!}</td>
            </tr>
            <!-- Created At Field -->
            <tr>
                <td><b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b></td>
                <td>{!! $community->created_at !!}</td>
            </tr>
            <!-- Updated At Field -->
            <tr>
                <td><b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b></td>
                <td>{!! $community->updated_at !!}</td>
            </tr>

        </tbody>        
    </table>
</div>