<div class="mb-0 table-responsive">
    <table class="table" id="people-table">
        <thead>
            <tr>
                <th></th>
                <th>{{ __('functionalities.people_var.identification') }}</th>
                <th>{{ __('functionalities.people_var.fullname') }}</th>
                <th>{{ __('functionalities.people_var.email') }}</th>
                
                <th>{{ __('functionalities.people_var.birth') }}</th>
                
                <th>{{ __('functionalities.people_var.phone') }}</th>
            
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($people as $person)
            <tr>
                <td>
                    @if ($person->status == 0)
                        <span style="color: blue;">
                            <i class="fas fa-user-plus"></i>
                        </span>
                    @elseif($person->status == 1)
                        <span style="color: green;">
                            <i class="fas fa-user-check"></i>
                        </span>
                    @endif
                </td>
                <td>{{ $person->identification }}</td>
                <td>{{ $person->fullname }}</td>
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
                        <a href="{{ route('people.show', [$person->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-search"></i></a>
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
