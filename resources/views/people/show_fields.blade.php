<!-- features Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('communities', trans_choice('functionalities.communities', 2)) !!}</b>
    <p>
    @foreach($communities as $community)
        <span class="badge badge-info">{{ $community->name }}</span>
    @endforeach
    </p>
</div>

<!-- Identification Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('identification', __('functionalities.people_var.identification')) !!}</b>
    <p>{{ $person->identification }}</p>
</div>

<!-- First Name Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('first_name', __('functionalities.people_var.first_name')) !!}</b>
    <p>{{ $person->first_name }}</p>
</div>

<!-- Last Name Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('last_name', __('functionalities.people_var.last_name')) !!}</b>
    <p>{{ $person->last_name }}</p>
</div>

<!-- Email Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('email', __('functionalities.people_var.email')) !!}</b>
    <p>{{ $person->email }}</p>
</div>

<!-- Sex Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('sex', __('functionalities.people_var.sex')) !!}</b>
    <p>{{ $person->genlist->item_description }}</p>
</div>

<!-- Address Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('address', __('functionalities.people_var.address')) !!}</b>
    <p>{{ $person->address }}</p>
</div>

<!-- Birth Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('birth', __('functionalities.people_var.birth')) !!}</b>
    <p>
        @if($person->birth != null)
            {{ $person->birth->toDateString() }}
        @endif
    </p>
</div>

<!-- City Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('city', __('functionalities.people_var.city')) !!}</b>
    <p>{{ $person->city }}</p>
</div>

<!-- Country Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('country', __('functionalities.people_var.country')) !!}</b>
    <p>{{ $person->country }}</p>
</div>

<!-- Phone Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('phone', __('functionalities.people_var.phone')) !!}</b>
    <p>{{ $person->phone }}</p>
</div>

{{--  
    <!-- Photo Field -->
    <div class="form-group col-sm-12">
        <b>{!! Form::label('photo', __('functionalities.people_var.photo')) !!}</b>
        <p>{{ $person->photo }}</p>
    </div>
--}}

<!-- features Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('features', trans_choice('functionalities.features', 2)) !!}</b>
    <p>
    @foreach($person->features->pluck('name') as $feature)
        <span class="badge badge-info">{{ $feature }}</span>
    @endforeach
    </p>
</div>

<!-- groups Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('groups', trans_choice('functionalities.groups', 2)) !!}</b>
    @if($groups != null)
        <p>
        @foreach($groups as $group)
            <span class="badge badge-info">{{ $group->name }}</span>
        @endforeach
        </p>
    @endif
</div>

<!-- profiles Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('profiles', trans_choice('functionalities.profiles', 2)) !!}</b>
    @if($profiles != null)
        <p>
        @foreach($profiles as $profile)
            <span class="badge badge-info">{{ $profile->name }}</span>
        @endforeach
        </p>
    @endif
</div>


<!-- Created At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b>
    <p>{{ $person->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b>
    <p>{{ $person->updated_at }}</p>
</div>

