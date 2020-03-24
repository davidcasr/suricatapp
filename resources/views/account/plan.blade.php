@foreach($plans as $plan)    
    
    <div class="col-sm-6">
        <!-- Name Field -->
        <div class="form-group col-sm-12">
            <b>{!! Form::label('name',  __('functionalities.plans_var.name')) !!} </b>
            <p>{!! $plan->name !!}</p>
        </div>

        <!-- Price Field -->
        <div class="form-group col-sm-12">
            <b>{!! Form::label('price',  __('functionalities.plans_var.price')) !!} </b>
            <p>{!! $plan->price !!}</p>
        </div>

        <!-- Q Users Field -->
        <div class="form-group col-sm-12">
            <b>{!! Form::label('q_users',  __('functionalities.plans_var.q_users')) !!} </b>
            <p>{!! $plan->q_users !!}</p>
        </div>

        <!-- Q Administrators Field -->
        <div class="form-group col-sm-12">
            <b>{!! Form::label('q_administrators',  __('functionalities.plans_var.q_administrators')) !!} </b>
            <p>{!! $plan->q_administrators !!}</p>
        </div>
    </div>

    <div class="col-sm-6">
        <!-- Q Communities Field -->
        <div class="form-group col-sm-12">
            <b>{!! Form::label('q_communities',  __('functionalities.plans_var.q_communities')) !!} </b>
            <p>{!! $plan->q_communities !!}</p>
        </div>

        <!-- Status Field -->
        <div class="form-group col-sm-12">
            <b>{!! Form::label('status', __('functionalities.plan_users_var.status')) !!} </b>
            @if ($plan->status == 0)
                <p>
                    <span style="color: red;">
                        <i class="fas fa-times-circle"></i>
                    </span>
                </p>
            @elseif($plan->status == 1)
                <p>
                    <span style="color: green;">
                        <i class="fas fa-check-circle"></i>
                    </span>
                </p>
            @endif
        </div>      

        <!-- Date Activation Field -->
        <div class="form-group col-sm-12">
            <b>{!! Form::label('date_activation', __('functionalities.plan_users_var.date_activation')) !!} </b>
            <p>{!! $plan->date_activation !!}</p>
        </div>

        <!-- Date Deadline Field -->
        <div class="form-group col-sm-12">
            <b>{!! Form::label('date_deadline', __('functionalities.plan_users_var.date_deadline')) !!} </b>
            <p>{!! $plan->date_deadline !!}</p>
        </div>
    </div>


@endforeach