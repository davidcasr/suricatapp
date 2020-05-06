<div class="table-responsive table-striped">
    <table class="table" id="people-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.people_var.fullname') }}</th>
                <th>{{ __('functionalities.people_var.email') }}</th>
                <th>{{ __('functionalities.people_var.phone') }}</th>
                <th>@choice('functionalities.profiles', 1)</th>
                <th colspan="3">{{ __('functionalities.action') }}</th>
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
                <td>
                    <div class='btn-group'>
                        <a href="{{ route('people.show', [$person->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-search"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>