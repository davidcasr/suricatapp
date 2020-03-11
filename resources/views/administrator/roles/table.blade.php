<div class="table-responsive table-striped">
    <table class="table" id="roles-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.roles_var.name') }}</th>
                <th>{{ __('functionalities.roles_var.title') }}</th>
                <th>{{ __('functionalities.roles_var.level') }}</th>
                <th>{{ __('functionalities.roles_var.scope') }}</th>
                <th>{{ __('functionalities.roles_var.abilities') }}</th>
                
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>{{ $role->title }}</td>
                <td>{{ $role->level }}</td>
                <td>{{ $role->scope }}</td>
                <td>
                    @foreach($role->abilities as $abilitie)
                        <span class="badge badge-info">{{ $abilitie->title }}</span>
                    @endforeach
                </td>

                <td>
                    {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('roles.show', [$role->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-eye"></i></a>
                        <a href="{{ route('roles.edit', [$role->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
