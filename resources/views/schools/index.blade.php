@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Schools</h2>
            </div>
            <div class="pull-right">
                @can('school-create')
                <a class="btn btn-success" href="{{ route('schools.create') }}"> Create New school</a>
                @endcan
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
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
	    @foreach ($schools as $school)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $school->name }}</td>
	        <td>{{ $school->detail }}</td>
	        <td>
                <form action="{{ route('schools.destroy',$school->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('schools.show',$school->id) }}">Show</a>
                    @can('school-edit')
                    <a class="btn btn-primary" href="{{ route('schools.edit',$school->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('school-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>


    {!! $schools->links() !!}


<p class="text-center text-primary"><small>Vipin kumar</small></p>
@endsection