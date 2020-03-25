@if(isset($subgroup))
	<!-- Communities Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('communities', 'Comunidad') !!}
		{!! Form::select('communities[]', $communities, null, ['class' => 'form-control','multiple' => 'multiple', 'id' => 'communities']) !!} 
    </div>
@else
	@if($communities != null)
		<!-- Communities Field -->
	    <div class="form-group col-sm-12">
	        {!! Form::label('communities', 'Comunidad') !!}
	        {!! Form::select('communities[]', $communities, null, ['class' => 'form-control','multiple' => 'multiple', 'id' => 'communities']) !!} 
	    </div>
	@endif
@endif

@if(isset($subgroup))
	<!-- Parent Id Field -->
	<div class="form-group col-sm-12">
	    {!! Form::label('parent_id', __('functionalities.groups_var.parent_id')) !!}
	    <p>{{ $subgroup }}</p>
	    {!! Form::hidden('parent_id', $subgroup) !!}
	    @foreach($levels as $level)
		    @if($level->level >= 0)
		    	{!! Form::hidden('level', $level->level + 1) !!}
		    @endif
	    @endforeach
	    
	</div>
@else
	{!! Form::hidden('level', 0) !!}
@endif

<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', __('functionalities.groups_var.name')) !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', __('functionalities.groups_var.description')) !!}
    {!! Form::textarea('description', null, ['class' => 'form-control ckeditor','maxlength' => 250]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('groups.index') }}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>

@section('scripts')
   <script>
        $(document).ready(function () {
           $('#communities').select2({
               width: '100%',
           });
        });     
    </script>
@endsection
