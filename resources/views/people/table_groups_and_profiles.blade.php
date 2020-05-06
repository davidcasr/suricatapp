
<div class="table-responsive table-striped">
    <table class="table" id="community-people-table">
        <thead>
            <tr>
                <th>Grupo</th>
                <th>Perfil</th>
                <th colspan="3">{{ __('functionalities.action') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($community_people as $group_and_profile)
            <tr>
                <td>
                    @foreach($group_and_profile->groups as $group)
                        {{ $group->name }} 
                    @endforeach
                </td>
                <td>
                    @foreach($group_and_profile->profiles as $profile)
                        {{ $profile->name }} 
                    @endforeach
                </td>
                <td>
                    {!! Form::open(['route' => ['communityPeople.destroy', $group_and_profile->id, 'person_id' => $group_and_profile->person_id ], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        {!! Form::button('<i class="fas fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Está seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
