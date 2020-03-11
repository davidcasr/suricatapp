@extends('layouts.app')

@section('content')
<div class="main-card card">
        <div class="card-body">
         <div class="content">
             @include('adminlte-templates::common.errors')
             <div class="box box-primary">
                 <div class="box-body">
                     <div class="row">
                         {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch']) !!}

                         @include('administrator.roles.fields')

                         {!! Form::close() !!}
                     </div>
                 </div>
             </div>
         </div>
   </div>
</div>
@endsection
