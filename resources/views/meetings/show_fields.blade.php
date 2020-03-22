{{--  

    <!-- User Id Field -->
    <div class="form-group col-sm-12">
        <b>{!! Form::label('user_id', __('functionalities.meetings_var.user_id')) !!}</b>
        <p>{{ $meeting->user_id }}</p>
    </div>

    <!-- Person Id Field -->
    <div class="form-group col-sm-12">
        <b>{!! Form::label('person_id', __('functionalities.meetings_var.person_id')) !!}</b>
        <p>{{ $meeting->person_id }}</p>
    </div>
--}}

<!-- Name Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('name', __('functionalities.meetings_var.name')) !!}</b>
    <p>{{ $meeting->name }}</p>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('description', __('functionalities.meetings_var.description')) !!}</b>
    <p>{{ $meeting->description }}</p>
</div>

<!-- Date Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('date', __('functionalities.meetings_var.date')) !!}</b>
    <p>{{ $meeting->date->toDateString() }}</p>
</div>

<!-- Time Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('time', __('functionalities.meetings_var.time')) !!}</b>
    <p>{{ \Carbon\Carbon::parse($meeting->time)->format('h:i A') }}</p>
</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('address', __('functionalities.meetings_var.address')) !!}</b>
    <p>{{ $meeting->address }}</p>
</div>

{{--  
    <!-- Latitude Field -->
    <div class="form-group col-sm-12">
        <b>{!! Form::label('latitude', __('functionalities.meetings_var.latitude')) !!}</b>
        <p>{{ $meeting->latitude }}</p>
    </div>

    <!-- Longitude Field -->
    <div class="form-group col-sm-12">
        <b>{!! Form::label('longitude', __('functionalities.meetings_var.longitude')) !!}</b>
        <p>{{ $meeting->longitude }}</p>
    </div>
--}}

<!-- Created At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b>
    <p>{{ $meeting->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b>
    <p>{{ $meeting->updated_at }}</p>
</div>

