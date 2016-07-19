@extends('app')
@section('pagetitle')
Create book
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
	{!! Form::open(['url' => 'books']) !!}
		<div class="form-group">
			{!! Form::label('title', 'Title') !!}
			{!! Form::text('title', $request->old('title'), ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('author', 'Author') !!}
			{!! Form::text('author', $request->old('author'), ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">	
			{!! Form::label('year', 'Year') !!}
			{!! Form::text('year', $request->old('year'), ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">	
			{!! Form::label('genre', 'Genre') !!}
			{!! Form::text('genre', $request->old('genre'), ['class' => 'form-control']) !!}
		</div>

		{!! Form::submit("Create", ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop