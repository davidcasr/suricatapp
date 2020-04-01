<div class="table-responsive table-striped">
    <table class="table">
        <tbody>
            <!-- first_name Field -->
            <tr>
                <td><b>{!! Form::label('first_name', __('functionalities.users_var.first_name')) !!}</b></td>
                <td>{!! $user->first_name !!}</td>
            </tr>
            <!-- last_name Field -->
            <tr>
                <td><b>{!! Form::label('last_name', __('functionalities.users_var.last_name')) !!}</b></td>
                <td>{!! $user->last_name !!}</td>
            </tr>
            <!-- username Field -->
            <tr>
                <td><b>{!! Form::label('username', __('functionalities.users_var.username')) !!}</b></td>
                <td>{!! $user->username !!}</td>
            </tr>
            <!-- email Field -->
            <tr>
                <td><b>{!! Form::label('email', __('functionalities.users_var.email')) !!}</b></td>
                <td>{!! $user->email !!}</td>
            </tr>
            <!-- phone Field -->
            <tr>
                <td><b>{!! Form::label('phone', __('functionalities.users_var.phone')) !!}</b></td>
                <td>{!! $user->phone !!}</td>
            </tr>
            <!-- role Field -->
            <tr>
                <td><b>{!! Form::label('role', __('functionalities.users_var.roles')) !!}</b></td>
                <td>
                    @foreach($user->roles->pluck('name') as $role)
                        <span class="badge badge-info">{{ $role }}</span>
                    @endforeach
                </td>
            </tr>
            <!-- Created At Field -->
            <tr>
                <td><b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b></td>
                <td>{!! $user->created_at !!}</td>
            </tr>
            <!-- Updated At Field -->
            <tr>
                <td><b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b></td>
                <td>{!! $user->updated_at !!}</td>
            </tr>
        </tbody>        
    </table>
</div>
