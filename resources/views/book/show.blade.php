@extends('app')
@section('pagetitle')
Book #{{ $book->id }}
@stop

@section('content')
	<ul class="list-group">
	  <li class="list-group-item"><b>Title</b>: {{ $book->title }}</li>
	  <li class="list-group-item"><b>Author</b>: {{ $book->author }}</li>
	  <li class="list-group-item"><b>Year</b>: {{ $book->year }}</li>
	  <li class="list-group-item"><b>Genre</b>: {{ $book->genre }}</li>
	</ul>
@stop