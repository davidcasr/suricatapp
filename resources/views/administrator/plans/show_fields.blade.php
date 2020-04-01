<div class="table-responsive table-striped">
    <table class="table">
        <tbody>
            <!-- Identification Field -->
            <tr>
                <td><b>{!! Form::label('identification',  __('functionalities.plans_var.identification')) !!} </b></td>
                <td>{!! $plan->identification !!}</td>
            </tr>
            <!-- Name Field -->
            <tr>
                <td><b>{!! Form::label('name',  __('functionalities.plans_var.name')) !!} </b></td>
                <td>{!! $plan->name !!}</td>
            </tr>
            <!-- Price Field -->
            <tr>
                <td><b>{!! Form::label('price',  __('functionalities.plans_var.price')) !!} </b></td>
                <td>{!! $plan->price !!}</td>
            </tr>
            <!-- Q Users Field -->
            <tr>
                <td><b>{!! Form::label('q_users',  __('functionalities.plans_var.q_users')) !!} </b></td>
                <td>{!! $plan->q_users !!}</td>
            </tr>
            <!-- Q Administrators Field -->
            <tr>
                <td><b>{!! Form::label('q_administrators',  __('functionalities.plans_var.q_administrators')) !!} </b></td>
                <td>{!! $plan->q_administrators !!}</td>
            </tr>
            <!-- Q Communities Field -->
            <tr>
                <td><b>{!! Form::label('q_communities',  __('functionalities.plans_var.q_communities')) !!} </b></td>
                <td>{!! $plan->q_communities !!}</td>
            </tr>
            <!-- Created At Field -->
            <tr>
                <td><b>{!! Form::label('created_at', __('functionalities.created_at')) !!} </b></td>
                <td>{!! $plan->created_at !!}</td>
            </tr>
            <!-- Updated At Field -->
            <tr>
                <td><b>{!! Form::label('updated_at',  __('functionalities.updated_at')) !!} </b></td>
                <td>{!! $plan->updated_at !!}</td>
            </tr>
        </tbody>        
    </table>
</div>