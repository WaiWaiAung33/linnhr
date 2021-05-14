@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
@stop
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h5>Create New Role</h5>
        </div>
      {{--   <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div> --}}
    </div>
</div>


@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

{!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 text-center">
        <div class="form-group">
            <strong>&nbsp;</strong>
            <button type="submit" class="btn btn-success form-control">Save</button>
        </div>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 text-center">
        <div class="form-group">
            <strong>&nbsp;</strong>
            <a class="btn btn-secondary form-control"  href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">

    </div>
</div>
<div class="row">
    <strong>Permissions:</strong>
        <div class="table-responsive" style="font-size:14px">
            <table class="table table-bordered styled-table">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Name</td>
                        <td>Read</td>
                        <td>Create</td>
                        <td>Update</td>
                        <td>Delete</td>
                        {{-- <td>Export</td> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $i=>$permission)
                        @php
                            $ids = explode(',', $permission->ids);
                            $strArr = explode(',', $permission->name);
                        @endphp
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $permission->model }}</td>
                            @foreach($ids as $k=>$id)
                            <td>
                                 <label>{{ Form::checkbox('permission[]', $id, false, array('class' => 'name')) }}
                                </label>
                            </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>    
            </table>
        </div>
</div>
{!! Form::close() !!}

@stop