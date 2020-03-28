@extends('layouts.app')

@section('content')
<div class="main-card card">
        <div class="card-body">
         <div class="content">
             @include('adminlte-templates::common.errors')
             <div class="box box-primary">
                 <div class="box-body">
                     <div class="row">
                        <div class="col-sm-6">
                             {!! Form::model($user, ['route' => ['account.update', $user->id], 'method' => 'patch']) !!}

                             @include('account.fields')

                             {!! Form::close() !!}
                        </div>
                     </div>
                 </div>
             </div>
         </div>
   </div>
</div>
@endsection

