@extends('app')
@section('pagetitle')
Edit user
@stop

@section('content')
	@if (count($errors) > 0)
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	
	{!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}
		<div class="form-group">
			{!! Form::label('name', 'Name') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('password', 'Password') !!}
			{!! Form::password('password', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">	
			{!! Form::label('email', 'Email') !!}
			{!! Form::email('email', null, ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">	
			{!! Form::label('is_admin', 'Admin') !!}
			{!! Form::checkbox('is_admin', null, $user->is_admin) !!}
		</div>
		{!! Form::submit("Update", ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop