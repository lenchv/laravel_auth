@extends('app')
@section('pagetitle')
Edit book
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
	
	{!! Form::model($book, ['route' => ['books.update', $book->id], 'method' => 'PUT']) !!}
		<div class="form-group">
			{!! Form::label('title', 'Title') !!}
			{!! Form::text('title', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('author', 'Author') !!}
			{!! Form::text('author', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">	
			{!! Form::label('year', 'Year') !!}
			{!! Form::text('year', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">	
			{!! Form::label('genre', 'Genre') !!}
			{!! Form::text('genre', null, ['class' => 'form-control']) !!}
		</div>

		{!! Form::submit("Update", ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop