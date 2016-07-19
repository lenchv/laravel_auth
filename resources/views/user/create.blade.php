@extends('app')
@section('pagetitle')
Create user
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
	
	{!! Form::open(['url' => 'users']) !!}
		<div class="form-group">
			{!! Form::label('name', 'Name') !!}
			{!! Form::text('name', $request->old('name'), ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('password', 'Password') !!}
			{!! Form::password('password', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">	
			{!! Form::label('email', 'Email') !!}
			{!! Form::email('email', $request->old('email'), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">	
			{!! Form::label('is_admin', 'Admin') !!}
			{!! Form::checkbox('is_admin', $request->old('is_admin'), ['class' => 'form-control']) !!}
		</div>
		{!! Form::submit("Create", ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop