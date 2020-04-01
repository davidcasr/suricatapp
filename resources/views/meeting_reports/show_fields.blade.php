<div class="table-responsive table-striped">
    <table class="table">
        <tbody>
            <!-- Meeting Id Field -->
            <tr>
                <td><b>{!! Form::label('meeting_id', __('functionalities.meeting_reports_var.meeting_id')) !!}</b></td>
                <td>{{ $meetingReport->meetings->full_meeting }}</td>
            </tr>   
            <!-- Description Field -->
            <tr>
                <td><b>{!! Form::label('description', __('functionalities.meeting_reports_var.description')) !!}</b></td>
                <td>{!! $meetingReport->description !!}</td>
            </tr>
            <!-- Created At Field -->
            <tr>
                <td><b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b></td>
                <td>{{ $meetingReport->created_at }}</td>
            </tr>   
            <!-- Updated At Field -->
            <tr>
                <td><b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b></td>
                <td>{{ $meetingReport->updated_at }}</td>
            </tr>
        </tbody>        
    </table>
</div>