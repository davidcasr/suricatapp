<!-- Parent Id Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('parent_id', __('functionalities.groups_var.parent_id')) !!}</b>
    <p>
        
        @if($group->parent_id != null)
            @for ($i = 0; $i < $group->level; $i++)
                <i class="fas fa-chevron-right"></i>
            @endfor
            {{ $group->parent_id }} / {{ $group->subgroup->name }}
        @else
            <i class="fas fa-circle"></i>
        @endif
    </p>
</div>

<!-- Name Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('name', __('functionalities.groups_var.name')) !!}</b>
    <p>{{ $group->name }}</p>
</div>

<!-- Description Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('description', __('functionalities.groups_var.description')) !!}</b>
    <p>{!! $group->description !!}</p>
</div>

<!-- Subgroup Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('subgroup', __('functionalities.groups_var.subgroups')) !!}</b>
    <p>
        @foreach($group->subgroups as $subgroup)
            <span class="badge badge-info">{{ $subgroup->name }}</span>
        @endforeach   
    </p> 
</div>

<!-- Created At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b>
    <p>{{ $group->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group col-sm-12">
    <b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b>
    <p>{{ $group->updated_at }}</p>
</div>

