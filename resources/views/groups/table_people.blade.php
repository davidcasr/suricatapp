<div class="table-responsive table-striped">
    <table class="table" id="people-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.people_var.fullname') }}</th>
                <th>{{ __('functionalities.people_var.email') }}</th>
                <th>{{ __('functionalities.people_var.phone') }}</th>
                <th>@choice('functionalities.profiles', 1)</th>
            </tr>
        </thead>
        <tbody>
        @foreach($people as $person)
            <tr>
                <td>{{ $person->fullName }} </td>
                <td>{{ $person->email }}</td>
                <td>{{ $person->phone }}</td>
                <td>
                    @foreach($person->profiles as $profile)
                        {{ $profile->name }}
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>