<!-- User Id Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('user_id', __('functionalities.plan_users_var.user_id')) !!} </b>
    <p>{!! $planUser->user_id !!}</p>
</div>

<!-- Plan Id Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('plan_id', __('functionalities.plan_users_var.plan_id')) !!} </b>
    <p>{!! $planUser->plan_id !!}</p>
</div>

<!-- Status Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('status', __('functionalities.plan_users_var.status')) !!} </b>
    <p>{!! $planUser->status !!}</p>
</div>

<!-- Date Activation Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('date_activation', __('functionalities.plan_users_var.date_activation')) !!} </b>
    <p>{!! $planUser->date_activation !!}</p>
</div>

<!-- Date Deadline Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('date_deadline', __('functionalities.plan_users_var.date_deadline')) !!} </b>
    <p>{!! $planUser->date_deadline !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('created_at', __('functionalities.created_at')) !!} </b>
    <p>{!! $planUser->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!} </b>
    <p>{!! $planUser->updated_at !!}</p>
</div>

