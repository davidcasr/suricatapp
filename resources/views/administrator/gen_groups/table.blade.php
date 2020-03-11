<div class="table-responsive table-striped">
    <table class="table" id="gen_groups-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.gen_groups_var.group_cod') }}</th>
                <th>{{ __('functionalities.gen_groups_var.group_description') }}</th>
                <th>{{ __('functionalities.gen_groups_var.enabled') }}</th>
                
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($gen_groups as $gen_group)
            <tr>
                <td>{{ $gen_group->group_cod }}</td>
                <td>{{ $gen_group->group_description }}</td>
                <td>{{ $gen_group->enabled }}</td>
                                
                <td>
                    {!! Form::open(['route' => ['gen_groups.destroy', $gen_group->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('gen_groups.show', [$gen_group->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-eye"></i></a>
                        <a href="{{ route('gen_groups.edit', [$gen_group->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
