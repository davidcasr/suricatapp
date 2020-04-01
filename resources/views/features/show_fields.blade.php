<div class="table-responsive table-striped">
    <table class="table">
        <tbody>
            <!-- features Field -->
            <tr>
                <td><b>{!! Form::label('communities', trans_choice('functionalities.communities', 2)) !!}</b></td>
                <td>
                    @foreach($feature->communities->pluck('name') as $community)
                        <span class="badge badge-info">{{ $community }}</span>
                    @endforeach
                </td>
            </tr>
            <!-- Name Field -->    
            <tr>
                <td><b>{!! Form::label('name', __('functionalities.features_var.name')) !!}</b></td>
                <td>{{ $feature->name }}</td>
            </tr>   
            <!-- Description Field -->
            <tr>
                <td><b>{!! Form::label('description', __('functionalities.features_var.description')) !!}</b></td>
                <td>{!! $feature->description !!}</td>
            </tr>
            <!-- Created At Field -->
            <tr>
                <td><b>{!! Form::label('created_at', __('functionalities.created_at')) !!}</b></td>
                <td>{{ $feature->created_at }}</td>
            </tr>
            <!-- Updated At Field -->
            <tr>
                <td><b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b></td>
                <td>{{ $feature->updated_at }}</td>
            </tr>
        </tbody>        
    </table>
</div>



    
    




    
    


