@extends('app')
@section('pagetitle')
Add book to user {{$user->firstname}} {{ $user->lastname }}
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
	
	{!! Form::open(['url' => 'userbooks']) !!}
		{!! Form::hidden('user_id', $user->id) !!}
		<div class="form-group">
			{!! Form::label('book_id', 'Books') !!}
			{!! Form::select('book_id', $books) !!}
		</div>

		{!! Form::submit("Add", ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop