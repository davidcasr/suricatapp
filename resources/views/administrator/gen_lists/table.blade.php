<div class="table-responsive table-striped">
    <table class="table" id="gen_lists-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.gen_lists_var.group_id') }}</th>
                <th>{{ __('functionalities.gen_lists_var.item_id') }}</th>
                <th>{{ __('functionalities.gen_lists_var.item_description') }}</th>
                <th>{{ __('functionalities.gen_lists_var.item_cod') }}</th>
                <th>{{ __('functionalities.gen_lists_var.enabled') }}</th>
                
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($gen_lists as $gen_list)
            <tr>
                <td>{{ $gen_list->group_id }}</td>
                <td>{{ $gen_list->item_id }}</td>
                <td>{{ $gen_list->item_description }}</td>
                <td>{{ $gen_list->item_cod }}</td>
                <td>{{ $gen_list->enabled }}</td>
                
                <td>
                    {!! Form::open(['route' => ['gen_lists.destroy', $gen_list->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('gen_lists.show', [$gen_list->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-eye"></i></a>
                        <a href="{{ route('gen_lists.edit', [$gen_list->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
