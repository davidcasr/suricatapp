<div class="table-responsive">
    <table class="table" id="profiles-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.profiles_var.name') }}</th>
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($profiles as $profile)
            <tr>
                <td>{{ $profile->name }}</td>
                <td>
                    {!! Form::open(['route' => ['profiles.destroy', $profile->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('profiles.show', [$profile->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-eye"></i></a>
                        <a href="{{ route('profiles.edit', [$profile->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
