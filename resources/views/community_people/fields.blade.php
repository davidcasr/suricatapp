@if($groups != null)
	<!-- groups Field -->
	<div class="form-group col-sm-12">
	    {!! Form::label('groups', trans_choice('functionalities.groups', 2).'*') !!}
	    {!! Form::select('groups', $groups, null, ['class' => 'form-control', 'id' => 'groups', 'placeholder' => 'Seleccione un grupo', 'required']) !!}
	</div>
@endif

@if($profiles != null)
    <!-- profiles Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('profiles', trans_choice('functionalities.profiles', 1)) !!}
        {!! Form::select('profiles', $profiles, null, ['class' => 'form-control', 'id' => 'profiles', 'placeholder' => 'Seleccione un perfil']) !!}
    </div>
@endif

{!! Form::hidden('person_id', $person_id) !!}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('people.show', $person_id) }}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>

@section('scripts')
   <script>
        $(document).ready(function () {          
           
           $('#groups').select2({
               width: '100%',
           });

           $('#profiles').select2({
               width: '100%',
           });
        });     
    </script>
@endsection