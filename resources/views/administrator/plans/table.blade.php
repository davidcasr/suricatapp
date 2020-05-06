<div class="table-responsive table-striped">
    <table class="table" id="plans-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.plans_var.identification') }}</th>
                <th>{{ __('functionalities.plans_var.name') }}</th>
                <th>{{ __('functionalities.plans_var.price') }}</th>
                <th>{{ __('functionalities.plans_var.q_users') }}</th>
                <th>{{ __('functionalities.plans_var.q_administrators') }}</th>
                <th>{{ __('functionalities.plans_var.q_communities') }}</th>
                
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($plans as $plan)
            <tr>
                <td>{{ $plan->identification }}</td>
                <td>{{ $plan->name }}</td>
                <td>{{ $plan->price }}</td>
                <td>{{ $plan->q_users }}</td>
                <td>{{ $plan->q_administrators }}</td>
                <td>{{ $plan->q_communities }}</td>
                
                <td>
                    {!! Form::open(['route' => ['plans.destroy', $plan->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('plans.show', [$plan->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-search"></i></a>
                        <a href="{{ route('plans.edit', [$plan->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
