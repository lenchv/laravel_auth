<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\UserBook;
use App\User;
use App\Book;
use Gate;

class UserBooksController extends Controller
{
	public function __construct() {
		$this->middleware("auth");
	}
    public function show($userId) {
		if (Gate::denies("admin")) {
            abort(403);
        }
        $books = Book::all();
		$arBooks = array();
		foreach ($books as $book) {
			$arBooks[$book->id] = $book->title . "(" . $book->author . "), " . $book->year . ", " . $book->genre; 
		}
		$user = User::find($userId);
		return view("userbooks/add", ['books' => $arBooks, 'user' => $user]);        
    }
    public function store(Request $request) {
        if (Gate::denies("admin")) {
            abort(403);
        }
    	$userBook = new UserBook;
    	$userBook->user_id = $request->user_id;
    	$userBook->book_id = $request->book_id;
    	$userBook->save();
    	Session::flash("message", "Successfully added book to user");
    	return Redirect::to("users/{$request->user_id}");
    }
    public function destroy($id) {
    	if (Gate::denies("admin")) {
            abort(403);
        }
        $userBook = UserBook::find($id);
        $userBook->delete();
        Session::flash("message", "Successfully deleted book");
        return Redirect::back();
    }
}