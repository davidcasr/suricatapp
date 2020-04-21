<div class="table-responsive table-striped">
    <table class="table" id="assistants-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.people_var.fullname') }}</th>
                <th>{{ __('functionalities.people_var.email') }}</th>
                <th>{{ __('functionalities.people_var.phone') }}</th>
                <th>{{ __('functionalities.assistants_var.confirmation') }}</th>
                <th></th>
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($assistants as $assistant)
            <tr>
                <td>{{ $assistant->people->fullName }}</td>
                <td>{{ $assistant->people->email }}</td>
                <td>{{ $assistant->people->phone }}</td>
                <td>
                    @if ($assistant->confirmation == 0)
                        <span style="color: red;">
                            <i class="fas fa-times-circle"></i>
                        </span>
                    @elseif($assistant->confirmation == 1)
                        <span style="color: green;">
                            <i class="fas fa-check-circle"></i>
                        </span>
                        
                    @endif
                    
                </td>
                <td>
                    {!! Form::model($assistants, ['route' => ['assistants.update', $assistant->id], 'method' => 'patch']) !!}
                        {!! Form::hidden('person_id', $assistant->person_id) !!}
                        {!! Form::hidden('meeting_id', $meeting->id) !!}
                        @if($assistant->confirmation == 0)
                            {!! Form::hidden('confirmation', 1) !!}
                        @elseif($assistant->confirmation == 1)
                            {!! Form::hidden('confirmation', 0) !!}
                        @endif
                        {!! Form::submit('Cambiar asistencia', ['class' => 'btn btn-outline-primary btn-xs']) !!}
                    {!! Form::close() !!}
                </td>
                <td>
                    
                    {!! Form::open(['route' => ['assistants.destroy', $assistant->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                        </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@section('scripts')
    <script>
        $(document).ready(function () {
           $("#confirmation").change(function(){
                console.log('jojo');
                value = $('#confirmation').val()
                console.log(value)
            });
        });
    </script>
@endsection