<div class="mb-0 table-responsive">
    <table class="table" id="people-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.people_var.identification') }}</th>
                <th>{{ __('functionalities.people_var.first_name') }}</th>
                <th>{{ __('functionalities.people_var.last_name') }}</th>
                <th>{{ __('functionalities.people_var.email') }}</th>
                
                <th>{{ __('functionalities.people_var.birth') }}</th>
                
                <th>{{ __('functionalities.people_var.phone') }}</th>
            
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($people as $person)
            <tr>
                <td>{{ $person->identification }}</td>
                <td>{{ $person->first_name }}</td>
                <td>{{ $person->last_name }}</td>
                <td>{{ $person->email }}</td>
               
                <td>
                    @if($person->birth != null)
                        {{ $person->birth->toDateString() }}
                    @endif
                </td>
                <td>{{ $person->phone }}</td>
                
                <td>
                    {!! Form::open(['route' => ['people.destroy', $person->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('people.show', [$person->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-eye"></i></a>
                        <a href="{{ route('people.edit', [$person->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
