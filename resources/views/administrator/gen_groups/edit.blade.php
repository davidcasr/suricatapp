@extends('layouts.app')

@section('content')
<div class="main-card card">
        <div class="card-body">
         <div class="content">
             @include('adminlte-templates::common.errors')
             <div class="box box-primary">
                 <div class="box-body">
                     <div class="row">
                         {!! Form::model($genGroup, ['route' => ['genGroups.update', $genGroup->id], 'method' => 'patch']) !!}

                         @include('administrator.gen_groups.fields')

                         {!! Form::close() !!}
                     </div>
                 </div>
             </div>
         </div>
   </div>
</div>
@endsection

