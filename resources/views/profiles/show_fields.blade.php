<div class="table-responsive table-striped">
    <table class="table">
        <tbody>
        	<!-- Name Field -->
            <tr>
                <td><b>{!! Form::label('name', __('functionalities.profiles_var.name')) !!}</b></td>
                <td>{{ $profile->name }}</td>
            </tr>
			<!-- Description Field -->
            <tr>
                <td><b>{!! Form::label('description', __('functionalities.profiles_var.description')) !!}</b></td>
                <td>{{ $profile->description }}</td>
            </tr>
			<!-- Created At Field -->
            <tr>
                <td><b>{!! Form::label('created_at',  __('functionalities.created_at')) !!}</b></td>
                <td>{{ $profile->created_at }}</td>
            </tr>
			<!-- Updated At Field -->
            <tr>
                <td><b>{!! Form::label('updated_at', __('functionalities.updated_at')) !!}</b></td>
                <td>{{ $profile->updated_at }}</td>
            </tr>
        </tbody>        
    </table>
</div>