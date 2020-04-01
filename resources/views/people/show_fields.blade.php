<div class="table-responsive table-striped">
    <table class="table">
        <tbody>
            <!-- features Field -->
            <tr>
                <td><b>{!! Form::label('communities', trans_choice('functionalities.communities', 2)) !!}</b></td>
                <td>
                    @foreach($communities as $community)
                        <span class="badge badge-info">{{ $community->name }}</span>
                    @endforeach
                </td>
            </tr>
            <!-- Identification Field -->
            <tr>
                <td><b>{!! Form::label('identification', __('functionalities.people_var.identification')) !!}</b></td>
                <td>{{ $person->identification }}</td>
            </tr>
            <!-- First Name Field -->
            <tr>
                <td><b>{!! Form::label('first_name', __('functionalities.people_var.first_name')) !!}</b></td>
                <td>{{ $person->first_name }}</td>
            </tr>
            <!-- Last Name Field -->
            <tr>
                <td><b>{!! Form::label('last_name', __('functionalities.people_var.last_name')) !!}</b></td>
                <td>{{ $person->last_name }}</td>
            </tr>
            <!-- Email Field -->
            <tr>
                <td><b>{!! Form::label('email', __('functionalities.people_var.email')) !!}</b></td>
                <td>{{ $person->email }}</td>
            </tr>
            <!-- Sex Field -->
            <tr>
                <td><b>{!! Form::label('sex', __('functionalities.people_var.sex')) !!}</b></td>
                <td>{{ $person->genlist->item_description }}</td>
            </tr>
            <!-- Address Field -->
            <tr>
                <td><b>{!! Form::label('address', __('functionalities.people_var.address')) !!}</b></td>
                <td>{{ $person->address }}</td>
            </tr>
            <!-- Birth Field -->
            <tr>
                <td><b>{!! Form::label('birth', __('functionalities.people_var.birth')) !!}</b></td>
                <td>
                    @if($person->birth != null)
                        {{ $person->birth->toDateString() }}
                    @endif
                </td>
            </tr>
            <!-- City Field -->
            <tr>
                <td><b>{!! Form::label('city', __('functionalities.people_var.city')) !!}</b></td>
                <td>{{ $person->city }}</td>
            </tr>
            <!-- Country Field -->
            <tr>
                <td><b>{!! Form::label('country', __('functionalities.people_var.country')) !!}</b></td>
                <td>{{ $person->country }}</td>
            </tr>
            <!-- Phone Field -->
            <tr>
                <td><b>{!! Form::label('phone', __('functionalities.people_var.phone')) !!}</b></td>
                <td>{{ $person->phone }}</td>
            </tr>
            <!-- features Field -->
            <tr>
                <td><b>{!! Form::label('features', trans_choice('functionalities.features', 2)) !!}</b></td>
                <td>
                    @foreach($person->features->pluck('name') as $feature)
                        <span class="badge badge-info">{{ $feature }}</span>
                    @endforeach
                </td>
            </tr>
            <!-- groups Field -->
            <tr>
                <td><b>{!! Form::label('groups', trans_choice('functionalities.groups', 2)) !!}</b></td>
                <td>
                    @if($groups != null)
                        
                        @foreach($groups as $group)
                            <span class="badge badge-info">{{ $group->name }}</span>
                        @endforeach
                        
                    @endif
                </td>
            </tr>
            <!-- profiles Field -->
            <tr>
                <td><b>{!! Form::label('profiles', trans_choice('functionalities.profiles', 2)) !!}</b></td>
                <td>
                    @if($profiles != null)
                        
                        @foreach($profiles as $profile)
                            <span class="badge badge-info">{{ $profile->name }}</span>
                        @endforeach
                        
                    @endif
                </td>
            </tr>
            <!-- Created At Field -->
            <tr>
                <td><b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b></td>
                <td>{{ $person->created_at }}</td>
            </tr>
            <!-- Updated At Field -->
            <tr>
                <td><b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b></td>
                <td>{{ $person->updated_at }}</td>
            </tr>
        </tbody>        
    </table>
</div>