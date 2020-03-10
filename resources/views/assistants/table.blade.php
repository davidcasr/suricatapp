<div class="table-responsive table-striped">
    <table class="table" id="assistants-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.assistants_var.person_id') }}</th>
                <th>{{ __('functionalities.assistants_var.group_id') }}</th>
                <th>{{ __('functionalities.assistants_var.meeting_id') }}</th>
                <th>{{ __('functionalities.assistants_var.confirmation') }}</th>
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($assistants as $assistant)
            <tr>
                <td>{{ $assistant->person_id }}</td>
                <td>{{ $assistant->group_id }}</td>
                <td>{{ $assistant->meeting_id }}</td>
                <td>{{ $assistant->confirmation }}</td>
                <td>
                    {!! Form::open(['route' => ['assistants.destroy', $assistant->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('assistants.show', [$assistant->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-eye"></i></a>
                        <a href="{{ route('assistants.edit', [$assistant->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
