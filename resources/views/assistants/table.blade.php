<div class="table-responsive table-striped">
    <table class="table" id="assistants-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.assistants_var.meeting_id') }}</th>
                <th>{{ __('functionalities.assistants_var.person_id') }}</th>
                <th>{{ __('functionalities.assistants_var.confirmation') }}</th>
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($assistants as $assistant)
            <tr>
                <td>{{ $assistant->meetings->full_meeting }}</td>
                <td>{{ $assistant->people->email }}</td>

                @if ($assistant->confirmation == 0)
                    <td>
                        <span style="color: red;">
                            <i class="fas fa-times-circle"></i>
                        </span>
                    </td>
                @elseif($assistant->confirmation == 1)
                    <td>
                        <span style="color: green;">
                            <i class="fas fa-check-circle"></i>
                        </span>
                    </td>
                @elseif($assistant->confirmation == 2)
                    <td>
                        <span style="color: blue;">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </td>
                @endif

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
