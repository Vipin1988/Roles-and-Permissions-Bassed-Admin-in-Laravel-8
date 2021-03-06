@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Students Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('students.create') }}"> Create New Student</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Detail</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($students as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->detail }}</td>
    <td>
       <a class="btn btn-info" href="{{ route('students.show',$user->id) }}">Show</a>
       <a class="btn btn-primary" href="{{ route('students.edit',$user->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['students.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>


{!! $students->render() !!}


<p class="text-center text-primary"><small>Vipin kumar</small></p>
@endsection