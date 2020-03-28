@extends('layouts.app')

@section('content')
<div class="main-card mb-3 card">
        <div class="card-body">
         <div class="content">
             @include('adminlte-templates::common.errors')
             <div class="box box-primary">
                 <div class="box-body">
                     <div class="row">
                        <div class="col-sm-6">
                             {!! Form::model($assistant, ['route' => ['assistants.update', $assistant->id], 'method' => 'patch']) !!}

                                  @include('assistants.fields')

                             {!! Form::close() !!}
                        </div>
                     </div>
                 </div>
             </div>
         </div>
   </div>
</div>
@endsection



