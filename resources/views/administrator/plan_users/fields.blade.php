<!-- User Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('user_id',  __('functionalities.plan_users_var.user_id')) !!}
    {!! Form::select('user_id', $users, null, ['class' => 'form-control' , 'required' => 'required']) !!}
</div>

<!-- Plan Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('plan_id',  __('functionalities.plan_users_var.plan_id')) !!}
    {!! Form::select('plan_id', $plans, null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('status',  __('functionalities.plan_users_var.status')) !!}
    {!! Form::select('status', ['0' => 'Inactivo', '1' => 'Activo'], null, ['class' => 'form-control']) !!}
</div>

<!-- Date Activation Field -->
<div class="form-group col-sm-12">
    {!! Form::label('date_activation',  __('functionalities.plan_users_var.date_activation')) !!}
    {!! Form::text('date_activation', null, ['class' => 'form-control','id'=>'date_activation']) !!}
</div>

<!-- Date Deadline Field -->
<div class="form-group col-sm-12">
    {!! Form::label('date_deadline',  __('functionalities.plan_users_var.date_deadline')) !!}
    {!! Form::text('date_deadline', null, ['class' => 'form-control','id'=>'date_deadline']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('buttons.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('planUsers.index') !!}" class="btn btn-default">{{ __('buttons.cancel') }}</a>
</div>

@section('scripts')
   <script type="text/javascript">
          $(document).ready(function () {
                 $('#user_id').select2({
                     width: '100%',
                 });
             });

         $('#date_activation').datetimepicker({
             format: 'YYYY-MM-DD',
             useCurrent: true,
             icons: {
                 up: "icon-arrow-up-circle icons font-2xl",
                 down: "icon-arrow-down-circle icons font-2xl"
             },
             sideBySide: true
         })

         $('#date_deadline').datetimepicker({
             format: 'YYYY-MM-DD',
             useCurrent: true,
             icons: {
                 up: "icon-arrow-up-circle icons font-2xl",
                 down: "icon-arrow-down-circle icons font-2xl"
             },
             sideBySide: true
         })
     </script>
@endsection
