<div class="table-responsive table-striped">
    <table class="table" id="meetingReports-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.meeting_reports_var.meeting_id') }}</th>
                <th>{{ __('functionalities.meeting_reports_var.description') }}</th>
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($meetingReports as $meetingReport)
            <tr>
                <td>{{ $meetingReport->meetings->full_meeting }}</td>
                <td>{!! $meetingReport->description !!}</td>
                <td>
                    {!! Form::open(['route' => ['meetingReports.destroy', $meetingReport->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('meetingReports.show', [$meetingReport->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-eye"></i></a>
                        <a href="{{ route('meetingReports.edit', [$meetingReport->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
