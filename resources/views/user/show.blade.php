@extends('app')
@section('pagetitle')
	Books {{ $user->name }} {{ $user->email }}
@stop

@section('content')
	<ul class="list-group">
	@foreach ($books as $book)
	  	<li class="list-group-item">
	  		<a href="{{ URL::to('books/' . $book->id) }}">
	  			{{ $book->author }}, {{ $book->title }}, {{ $book->year }}, {{ $book->genre }}
			</a>
		@can('admin')
			
			{!! Form::open(['url' => '/userbooks/' . $book->pivot->id, 'style' => "display: inline", 'method' => "DELETE"]) !!}
			{!! Form::submit("Delete", ['class' => 'btn btn-danger']) !!}
			{!! Form::close() !!}
		@endcan
		</li>
	@endforeach
	</ul>
	@can('admin')
		<a class="btn btn-primary" href="{{ URL::to('userbooks/' . $user->id) }}">Add book</a>
	@endcan
@stop