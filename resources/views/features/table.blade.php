<div class="table-responsive">
    <table class="table" id="features-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.features_var.name') }}</th>
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($features as $feature)
            <tr>
                <td>{{ $feature->name }}</td>
                <td>
                    {!! Form::open(['route' => ['features.destroy', $feature->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('features.show', [$feature->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-eye"></i></a>
                        <a href="{{ route('features.edit', [$feature->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
