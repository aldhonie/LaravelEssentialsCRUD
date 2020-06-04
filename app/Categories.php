<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable =[
        'name'
    ];

    public function books()
    {
        return $this->belongsToMany('App\Books', 'books_categories', 'book_id', 'category_id')->withTimestamps();
    }
}
