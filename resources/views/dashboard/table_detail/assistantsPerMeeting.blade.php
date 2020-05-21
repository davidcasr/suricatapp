<div class="table-responsive table-striped">
    <table class="table" id="data-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.people_var.fullname') }}</th>
                <th>{{ __('functionalities.assistants_var.meeting_id') }}</th>
                <th>{{ __('functionalities.assistants_var.confirmation') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($data as $assistant)
            <tr>
                <td>
                    @foreach($assistant->people as $person)
                        {{ $person->fullName}}
                    @endforeach
                </td>
                <td>
                    @foreach($assistant->meetings as $meeting)
                        {{ $meeting->fullMeeting }}
                    @endforeach
                </td>
                <td>
                    @if ($assistant->confirmation == 0)
                        <span style="color: red;">
                            <i class="fas fa-times-circle"></i>
                        </span>
                    @elseif($assistant->confirmation == 1)
                        <span style="color: green;">
                            <i class="fas fa-check-circle"></i>
                        </span>
                    @elseif($assistant->new_assistant == 1)
                        <span style="color: blue;">
                            <i class="fas fa-user-plus"></i>
                        </span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>