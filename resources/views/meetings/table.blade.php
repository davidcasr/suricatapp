<div class="table-responsive table-striped">
    <table class="table" id="meetings-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.meetings_var.name') }}</th>
                <th>{{ __('functionalities.meetings_var.description') }}</th>
                <th>{{ __('functionalities.meetings_var.date') }}</th>
                <th>{{ __('functionalities.meetings_var.time') }}</th>
                <th>{{ __('functionalities.meetings_var.address') }}</th>
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($meetings as $meeting)
            <tr>
                <td>{{ $meeting->name }}</td>
                <td>{{ $meeting->description }}</td>
                <td>{{ \Carbon\Carbon::parse($meeting->date)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($meeting->time)->format('h:i A') }} </td>
                <td>{{ $meeting->address }}</td>

                <td>
                    {!! Form::open(['route' => ['meetings.destroy', $meeting->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('meetings.show', [$meeting->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-eye"></i></a>
                        <a href="{{ route('meetings.edit', [$meeting->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
