<div class="table-responsive table-striped">
    <table class="table" id="communities-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.communities_var.identification') }}</th>
                <th>{{ __('functionalities.communities_var.name') }}</th>
                <th>{{ __('functionalities.communities_var.description') }}</th>
                <th>{{ __('functionalities.communities_var.address') }}</th>
                
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($communities as $community)
            <tr>
                <td>{{ $community->identification }}</td>
                <td>{{ $community->name }}</td>
                <td>{{ $community->description }}</td>
                <td>{{ $community->address }}</td>
                
                <td>
                    {!! Form::open(['route' => ['communities.destroy', $community->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('communities.show', [$community->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-eye"></i></a>
                        <a href="{{ route('communities.edit', [$community->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
