<div class="table-responsive table-striped">
    <table class="table">
        <tbody>
            
            <tr>
                <td><b>{!! Form::label('first_name', __('functionalities.roles_var.name')) !!}</b></td>
                <td>{!! $role->name !!}</td>
            </tr>
            
            <tr>
                <td><b>{!! Form::label('last_name', __('functionalities.roles_var.title')) !!}</b></td>
                <td>{!! $role->title !!}</td>
            </tr>
            
            <tr>
                <td><b>{!! Form::label('username', __('functionalities.roles_var.level')) !!}</b></td>
                <td>{!! $role->level !!}</td>
            </tr>
            
            <tr>
                <td><b>{!! Form::label('email', __('functionalities.roles_var.scope')) !!}</b></td>
                <td>{!! $role->scope !!}</td>
            </tr>
            
            <tr>
                <td><b>{!! Form::label('role', __('functionalities.roles_var.abilities')) !!}</b></td>
                <td>
                    @foreach($role->abilities->pluck('name') as $ability)
                        <span class="badge badge-info">{{ $ability }}</span>
                    @endforeach
                </td>
            </tr>
            <!-- Created At Field -->
            <tr>
                <td><b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b></td>
                <td>{!! $role->created_at !!}</td>
            </tr>
            <!-- Updated At Field -->
            <tr>
                <td><b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b></td>
                <td>{!! $role->updated_at !!}</td>
            </tr>
        </tbody>        
    </table>
</div>