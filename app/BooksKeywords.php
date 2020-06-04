<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BooksKeywords extends Model
{
    protected $table = 'books_keywords';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable =[
        'book_id',
        'keyword_id'
    ];
}
