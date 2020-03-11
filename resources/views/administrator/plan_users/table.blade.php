<div class="table-responsive table-striped">
    <table class="table" id="plan_users-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.plan_users_var.user_id') }}</th>
                <th>{{ __('functionalities.plan_users_var.plan_id') }}</th>
                <th>{{ __('functionalities.plan_users_var.status') }}</th>
                <th>{{ __('functionalities.plan_users_var.date_activation') }}</th>
                <th>{{ __('functionalities.plan_users_var.date_deadline') }}</th>
                
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($plan_users as $plan_user)
            <tr>
                <td>{{ $plan_user->user_id }}</td>
                <td>{{ $plan_user->plan_id }}</td>
                <td>{{ $plan_user->status }}</td>
                <td>{{ $plan_user->date_activation }}</td>
                <td>{{ $plan_user->date_deadline }}</td>
                                
                <td>
                    {!! Form::open(['route' => ['plan_users.destroy', $plan_user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('plan_users.show', [$plan_user->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-eye"></i></a>
                        <a href="{{ route('plan_users.edit', [$plan_user->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
