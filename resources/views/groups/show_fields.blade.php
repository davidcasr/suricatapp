<div class="table-responsive table-striped">
    <table class="table">
        <tbody>
            <!-- Parent Id Field -->
            <tr>
                <td><b>{!! Form::label('parent_id', __('functionalities.groups_var.parent_id')) !!}</b></td>
                <td>
                    @if($group->parent_id != null)
                        @for ($i = 0; $i < $group->level; $i++)
                            <i class="fas fa-chevron-right"></i>
                        @endfor
                        {{ $group->parent_id }} / {{ $group->subgroup->name }}
                    @else
                        <i class="fas fa-circle"></i>
                    @endif
                </td>
            </tr>
            <!-- Name Field -->
            <tr>
                <td><b>{!! Form::label('name', __('functionalities.groups_var.name')) !!}</b></td>
                <td>{{ $group->name }}</td>
            </tr>
            <!-- Description Field -->
            <tr>
                <td><b>{!! Form::label('description', __('functionalities.groups_var.description')) !!}</b></td>
                <td>{!! $group->description !!}</td>
            </tr>
            <!-- Subgroup Field -->
            <tr>
                <td><b>{!! Form::label('subgroup', __('functionalities.groups_var.subgroups')) !!}</b></td>
                <td>
                    @foreach($group->subgroups as $subgroup)
                        <span class="badge badge-info">{{ $subgroup->name }}</span>
                    @endforeach
                </td>
            </tr>
            <!-- Created At Field -->
            <tr>
                <td><b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b></td>
                <td>{{ $group->created_at }}</td>
            </tr>
            <!-- Updated At Field -->
            <tr>
                <td><b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b></td>
                <td>{{ $group->updated_at }}</td>
            </tr>
        </tbody>        
    </table>
</div>