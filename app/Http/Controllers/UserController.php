<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Gate;

class UserController extends Controller
{
	public function __construct() {
		$this->middleware("auth");
	}

    public function index() {
        $users = User::paginate(10);
        return view("user/index", ["users" => $users]);
    }
    public function create(Request $request) {
        if (Gate::denies("admin")) {
        	abort(403);
        }
        return view("user/create", ['request' => $request]);
    }
    public function store(Request $request) {
         if (Gate::denies("admin")) {
        	abort(403);
        }
        $rules = [
            "name" => "required|alpha",
            "email" => "required|email|unique:users",
            "password" => "required"
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to("users/create")
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            $user->is_admin = $request->is_admin;
            $user->save();
            Session::flash("message", "Successfully created user");
            return Redirect::to('users');
        }
    }
    public function show($id) {
        $user = User::find($id);
        $books = $user->books();
        return view("user/show", ['books' => $books->get(), 'user' => $user]);
    }
    public function edit($id) {
    	 if (Gate::denies("admin")) {
        	abort(403);
        }
        $user = User::find($id);
        return view("user/edit", ['user' => $user]);
    }
    public function update(Request $request, $id) {
        if (Gate::denies("admin")) {
        	abort(403);
        }
        $rules = [
            "name" => "required|alpha",
            "email" => "required|email",
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to("users/{$id}/edit")
                ->withErrors($validator);
        } else {
            $user = User::find($id);
            $user->name = $request->name;
            if ($request->password !== null) {
            	$user->password = bcrypt($request->password);
            }
            $user->email = $request->email;
            $user->is_admin = ($request->is_admin === "on" ? true : false);
            $user->save();
            Session::flash("message", "Successfully updated user");
            return Redirect::to('users');
        }
    }
    public function destroy($id) {
        if (Gate::denies("admin")) {
        	abort(403);
        }
        $user = User::find($id);
        $user->delete();
        Session::flash("message", "Successfully deleted user");
        return Redirect::to('users');
    }
}