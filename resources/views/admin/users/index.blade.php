@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')

<h5 style="color: blue;">User Management</h5>
    
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            {{-- <h2>Users Management</h2> --}}
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
        </div>
    </div>
</div>
<br>

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<div class="table-responsive" style="font-size:14px">
  <table class="table table-bordered styled-table">
     <thead>
       <tr>
         <th>No</th>
         <th>Name</th>
         <th>Email</th>
         <th>Roles</th>
         <th width="280px">Action</th>
       </tr>
      </thead>
      <tbody>
        @foreach ($data as $key => $user)
          <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                   <label class="badge badge-success">{{ $v }}</label>
                @endforeach
              @endif
            </td>
            <td>
               <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
               <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </td>
          </tr>
         @endforeach
      </tbody>  
  </table>
</div>


{!! $data->render() !!}

@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('toasterbootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('toastermin.css')}}">
@stop

@section('js')
<script src=" {{ asset('toasterjquery.js') }}" ></script>
<script type="text/javascript" src="{{asset('toastermin.js')}}"></script>
@stop