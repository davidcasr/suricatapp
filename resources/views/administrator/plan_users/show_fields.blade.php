<div class="table-responsive table-striped">
    <table class="table">
        <tbody>
            <!-- User Id Field -->
            <tr>
                <td><b>{!! Form::label('user_id', __('functionalities.plan_users_var.user_id')) !!} </b></td>
                <td>{!! $planUser->user_id !!}</td>
            </tr>
            <!-- Plan Id Field -->
            <tr>
                <td><b>{!! Form::label('plan_id', __('functionalities.plan_users_var.plan_id')) !!} </b></td>
                <td>{!! $planUser->plan_id !!}</td>
            </tr>
            <!-- Status Field -->
            <tr>
                <td><b>{!! Form::label('status', __('functionalities.plan_users_var.status')) !!} </b></td>
                <td>{!! $planUser->status !!}</td>
            </tr>
            <!-- Date Activation Field -->
            <tr>
                <td><b>{!! Form::label('date_activation', __('functionalities.plan_users_var.date_activation')) !!} </b></td>
                <td>{!! $planUser->date_activation !!}</td>
            </tr>
            <!-- Date Deadline Field -->
            <tr>
                <td><b>{!! Form::label('date_deadline', __('functionalities.plan_users_var.date_deadline')) !!} </b></td>
                <td>{!! $planUser->date_deadline !!}</td>
            </tr>
            <!-- Created At Field -->
            <tr>
                <td><b>{!! Form::label('created_at', __('functionalities.created_at')) !!} </b></td>
                <td>{!! $planUser->created_at !!}</td>
            </tr>
            <!-- Updated At Field -->
            <tr>
                <td><b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!} </b></td>
                <td>{!! $planUser->updated_at !!}</td>
            </tr>

        </tbody>        
    </table>
</div>