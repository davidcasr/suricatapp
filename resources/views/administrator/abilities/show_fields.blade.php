<div class="table-responsive table-striped">
    <table class="table">
        <tbody>
            <!-- name Field -->
            <tr>
                <td><b>{!! Form::label('name', __('functionalities.abilities_var.name')) !!}</b></td>
                <td>{!! $ability->name !!}</td>
            </tr>
            <!-- title Field -->
            <tr>
                <td><b>{!! Form::label('title', __('functionalities.abilities_var.title')) !!}</b></td>
                <td>{!! $ability->title !!}</td>
            </tr>
            <!-- entity_id Field -->
            <tr>
                <td><b>{!! Form::label('entity_id', __('functionalities.abilities_var.entity_id')) !!}</b></td>
                <td>{!! $ability->entity_id !!}</td>
            </tr>
            <!-- entity_type Field -->
            <tr>
                <td><b>{!! Form::label('entity_type', __('functionalities.abilities_var.entity_type')) !!}</b></td>
                <td>{!! $ability->entity_type !!}</td>
            </tr>
            <!-- options Field -->
            <tr>
                <td> <b>{!! Form::label('options', __('functionalities.abilities_var.options')) !!}</b></td>
                <td>
                    @foreach($ability->options as $ability)
                        {{ $ability }}
                    @endforeach
                </td>
            </tr>
            <!-- scope Field -->
            <tr>
                <td><b>{!! Form::label('scope', __('functionalities.abilities_var.scope')) !!}</b></td>
                <td>{!! $ability->scope !!}</td>
            </tr>
            <!-- Created At Field -->
            <tr>
                <td><b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b></td>
                <td>{!! $ability->created_at !!}</td>
            </tr>
            <!-- Updated At Field -->
            <tr>
                <td><b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b></td>
                <td>{!! $ability->updated_at !!}</td>
            </tr>
        </tbody>        
    </table>
</div>

