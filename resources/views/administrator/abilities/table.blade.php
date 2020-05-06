<div class="table-responsive table-striped">
    <table class="table" id="abilities-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.abilities_var.name') }}</th>
                <th>{{ __('functionalities.abilities_var.title') }}</th>
                <th>{{ __('functionalities.abilities_var.entity_id') }}</th>
                <th>{{ __('functionalities.abilities_var.entity_type') }}</th>
                <th>{{ __('functionalities.abilities_var.only_owned') }}</th>
                
                <th>{{ __('functionalities.abilities_var.scope') }}</th>
                
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($abilities as $ability)
            <tr>
                <td>{{ $ability->name }}</td>
                <td>{{ $ability->title }}</td>
                <td>{{ $ability->entity_id }}</td>
                <td>{{ $ability->entity_type }}</td>
                <td>{{ $ability->only_owned }}</td>
               
                <td>{{ $ability->scope }}</td>
                
                <td>
                    {!! Form::open(['route' => ['abilities.destroy', $ability->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('abilities.show', [$ability->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-search"></i></a>
                        <a href="{{ route('abilities.edit', [$ability->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
