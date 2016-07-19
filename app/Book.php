<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table="book";
    public function users() {
    	return $this->belongsToMany('App\User', 'user_book', 'book_id', 'user_id');
    }
}
