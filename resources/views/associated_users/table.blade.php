<div class="table-responsive table-striped">
    <table class="table" id="users-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.users_var.fullname') }}</th>
                <th>{{ __('functionalities.users_var.username') }}</th>
                <th>{{ __('functionalities.users_var.email') }}</th>
              
                <th>{{ __('functionalities.users_var.phone') }}</th>
                <th>{{ __('functionalities.users_var.roles') }}</th>
                
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->fullname }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                
                <td>{{ $user->phone }}</td>

                <td>
                    @foreach($user->roles as $rol)
                        <span class="badge badge-info">{{ $rol->title }}</span>
                    @endforeach
                </td>
                
                <td>
                    {!! Form::open(['route' => ['associatedUsers.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('associatedUsers.show', [$user->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-search"></i></a>
                        <a href="{{ route('associatedUsers.edit', [$user->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
