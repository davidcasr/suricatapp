<div class="table-responsive">
    <table class="table" id="groups-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.groups_var.parent_id') }}</th>
                <th>{{ __('functionalities.groups_var.identification') }}</th>
                <th>{{ __('functionalities.groups_var.name') }}</th>
                <th>{{ __('functionalities.groups_var.description') }}</th>
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($groups as $group)
            <tr>
                <td>{{ $group->parent_id }}</td>
                <td>{{ $group->identification }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->description }}</td>
                <td>
                    {!! Form::open(['route' => ['groups.destroy', $group->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('groups.show', [$group->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-eye"></i></a>
                        <a href="{{ route('groups.edit', [$group->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
