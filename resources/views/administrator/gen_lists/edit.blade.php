@extends('layouts.app')

@section('content')
<div class="main-card card">
        <div class="card-body">
         <div class="content">
             @include('adminlte-templates::common.errors')
             <div class="box box-primary">
                 <div class="box-body">
                     <div class="row">
                         {!! Form::model($genList, ['route' => ['genLists.update', $genList->id], 'method' => 'patch']) !!}

                         @include('administrator.gen_lists.fields')

                         {!! Form::close() !!}
                     </div>
                 </div>
             </div>
         </div>
   </div>
</div>
@endsection
