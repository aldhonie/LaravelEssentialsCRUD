<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable =[
        'title',
        'description',
        'price',
        'quantity',
        'publisher'
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Categories', 'books_categories', 'book_id', 'category_id')->withTimestamps();
    }

    public function keywords()
    {
        return $this->belongsToMany('App\Keywords', 'books_keywords', 'book_id', 'keyword_id')->withTimestamps();
    }
}
