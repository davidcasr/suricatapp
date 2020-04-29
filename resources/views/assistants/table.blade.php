<div class="table-responsive table-striped">
    <table class="table" id="assistants-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.assistants_var.person_id') }}</th>
                <th>{{ __('functionalities.assistants_var.meeting_id') }}</th>
                <th>{{ __('functionalities.assistants_var.confirmation') }}</th>
                <th></th>
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($assistants as $assistant)
            <tr>
                <td>{{ $assistant->person_id}}</td>
                <td>{{ $assistant->meeting_id }}</td>
                <td>{{ $assistant->confirmation }}</td>
                <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>