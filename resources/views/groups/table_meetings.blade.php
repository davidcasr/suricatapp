<div class="table-responsive table-striped">
    <table class="table" id="meetings-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.meetings_var.name') }}</th>
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
                <td>{{ \Carbon\Carbon::parse($meeting->date)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($meeting->time)->format('h:i A') }} </td>
                <td>{{ $meeting->address }}</td>
                <td>
                    <div class='btn-group'>
                        <a href="{{ route('meetings.show', [$meeting->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-search"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>