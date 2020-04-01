<div class="table-responsive table-striped">
    <table class="table">
        <tbody>
            <!-- Meeting Id Field -->
            <tr>
                <td><b>{!! Form::label('meeting_id', __('functionalities.assistants_var.meeting_id')) !!}</b></td>
                <td>{{ $assistant->meetings->full_meeting }}</td>
            </tr>
            <!-- Person Id Field -->
            <tr>
                <td><b>{!! Form::label('person_id', __('functionalities.assistants_var.person_id')) !!}</b></td>
                <td>{{ $assistant->people->email }}</td>
            </tr>
            <!-- Confirmation Field -->    
            <tr>
                <td><b>{!! Form::label('confirmation', __('functionalities.assistants_var.confirmation')) !!}</b></td>
                <td>
                    @if ($assistant->confirmation == 0)
                        <span style="color: red;">
                            <i class="fas fa-times-circle"></i>
                        </span>
                    @elseif($assistant->confirmation == 1)
                        <span style="color: green;">
                            <i class="fas fa-check-circle"></i>
                        </span>
                    @elseif($assistant->confirmation == 2)
                        <span style="color: blue;">
                            <i class="fas fa-envelope"></i>
                        </span>
                    @endif
                </td>
            </tr>
            <!-- Created At Field -->
            <tr>
                <td><b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b></td>
                <td>{{ $assistant->created_at }}</td>
            </tr>
            <!-- Updated At Field -->
            <tr>
                <td><b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b></td>
                <td>{{ $assistant->updated_at }}</td>
            </tr>
        </tbody>        
    </table>
</div>

