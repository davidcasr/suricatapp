<div class="table-responsive">
    <table class="table" id="groups-table">
        <thead>
            <tr>
                <th>{{ __('functionalities.groups_var.parent_id') }}</th>
                <th>{{ __('functionalities.groups_var.name') }}</th>

                <th>@choice('functionalities.communities', 2)</th>
                <th>@choice('functionalities.sub_groups', 1)</th>
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($groups as $group)        
            <tr>
                <td>
                    @if($group->parent_id != null)
                        @for ($i = 0; $i < $group->level; $i++)
                            <i class="fas fa-chevron-right"></i>
                        @endfor
                        {{ $group->subgroup->name }}
                    @else
                        <i class="fas fa-circle"></i>
                    @endif
                </td>
                <td>{{ $group->name }}</td>

                <td>
                    @foreach($group->communities as $community)
                        <span class="badge badge-info">{{ $community->name }}</span>
                    @endforeach
                </td>
                <td>
                    <div class='btn-group'>
                        <a href="{{ route('groups.create', ['subgroup' => $group->id]) }}" class='btn btn-warning btn-xs'>Crear Subgrupo</a>  
                    </div>
                </td>
                <td>
                    {!! Form::open(['route' => ['groups.destroy', $group->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('groups.show', [$group->id]) }}" class='btn btn-info btn-xs'><i class="fas fa-search"></i></a>
                        <a href="{{ route('groups.edit', [$group->id]) }}" class='btn btn-light btn-xs'><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
