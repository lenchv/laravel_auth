<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Book;
use Gate;
class BookController extends Controller
{
	public function __construct() {
		$this->middleware("auth");
	}
    //
    public function index() {
    	$books = Book::paginate(10);
    	return view("book/index", ["books" => $books]);
    }
    public function create(Request $request) {
        if (Gate::denies("admin")) {
            abort(403);
        }
        return view("book/create", ['request' => $request]);
    }
    public function store(Request $request) {
        if (Gate::denies("admin")) {
            abort(403);
        }
        $rules = [
            "title" => "required|alpha",
            "author" => "required|alpha",
            "year" => "required|integer|max:2016",
            "genre" => "required|alpha",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to("books/create")
                ->withErrors($validator)
                ->withInput();
        } else {
            $book = new Book();
            $book->title = $request->title;
            $book->author = $request->author;
            $book->year = $request->year;
            $book->genre = $request->genre;
            $book->save();
            Session::flash("message", "Successfully added book");
            return Redirect::to('books');
        }
    }
    public function show($id) {
        $book = Book::find($id);
        return view("book/show", ['book' => $book]);
    }
    public function edit($id) {
        if (Gate::denies("admin")) {
            abort(403);
        }
        $book = Book::find($id);
        return view("book/edit", ['book' => $book]);
    }
     public function update(Request $request, $id) {
        if (Gate::denies("admin")) {
            abort(403);
        }
        $rules = [
            "title" => "required|alpha",
            "author" => "required|alpha",
            "year" => "required|integer|max:2016",
            "genre" => "required|alpha",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to("books/{$id}/edit")
                ->withErrors($validator);
        } else {
            $book = Book::find($id);
            $book->title = $request->title;
            $book->author = $request->author;
            $book->year = $request->year;
            $book->genre = $request->genre;
            $book->save();
			Session::flash("message", "Successfully updated book");
            return Redirect::to('books');
        }
    }
    public function destroy($id) {
        if (Gate::denies("admin")) {
            abort(403);
        }
        $book = Book::find($id);
        $book->delete();
        Session::flash("message", "Successfully deleted book");
        return Redirect::to('books');
    }
}