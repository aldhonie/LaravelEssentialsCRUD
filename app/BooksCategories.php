<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BooksCategories extends Model
{
    protected $table = 'books_categories';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable =[
        'book_id',
        'category_id'
    ];
}
