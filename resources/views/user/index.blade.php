@extends("app")
@section('pagetitle')
User list
@stop

@section('content')
<div class="panel panel-default">
	@can('admin')
  <div class="panel-body">
		<a class="btn btn-success" href="{{ URL::to('/users/create') }}">Create user</a>
  </div>
	@endcan
</div>
<table class="table table-striped table-bordered">
	<thead>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Email</th>
		<th>Books</th>
	@can('admin')
		<th>Action</th>
	@endcan
	</tr>
	</thead>
	<tbody>
		@foreach($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>
					<a class="btn btn-warning" href="{{ URL::to('/users/' . $user->id) }}">Show</a>
				</td>
				@can('admin')
				<td>
					<a class="btn btn-info" href="{{ URL::to('/users/' . $user->id . '/edit') }}">Edit</a>
					{!! Form::open(['url' => '/users/' . $user->id, 'class' => "pull-right", 'method' => "DELETE"]) !!}
					{!! Form::submit("Delete", ['class' => 'btn btn-danger']) !!}
					{!! Form::close() !!}
				</td>
				@endcan
			</tr>
		@endforeach
	</tbody>
</table>
{{ $users->links() }}
@stop
