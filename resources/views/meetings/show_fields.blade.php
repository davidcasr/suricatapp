<div class="table-responsive table-striped">
    <table class="table">
        <tbody>
            <!-- Name Field -->
            <tr>
                <td><b>{!! Form::label('name', __('functionalities.meetings_var.name')) !!}</b></td>
                <td>{{ $meeting->name }}</td>
            </tr>
            <!-- Description Field -->
            <tr>
                <td><b>{!! Form::label('description', __('functionalities.meetings_var.description')) !!}</b></td>
                <td>{{ $meeting->description }}</td>
            </tr>
            <!-- Date Field -->
            <tr>
                <td><b>{!! Form::label('date', __('functionalities.meetings_var.date')) !!}</b></td>
                <td>{{ $meeting->date->toDateString() }}</td>
            </tr>
            <!-- Time Field -->
            <tr>
                <td><b>{!! Form::label('time', __('functionalities.meetings_var.time')) !!}</b></td>
                <td>{{ \Carbon\Carbon::parse($meeting->time)->format('h:i A') }}</td>
            </tr>
            <!-- Address Field -->
            <tr>
                <td><b>{!! Form::label('address', __('functionalities.meetings_var.address')) !!}</b></td>
                <td>{{ $meeting->address }}</td>
            </tr>
            <!-- Created At Field -->
            <tr>
                <td><b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b></td>
                <td>{{ $meeting->created_at }}</td>
            </tr>
            <!-- Updated At Field -->
            <tr>
                <td><b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b></td>
                <td>{{ $meeting->updated_at }}</td>
            </tr>

        </tbody>        
    </table>
</div>
