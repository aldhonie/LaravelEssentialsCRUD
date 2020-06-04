<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keywords extends Model
{
    protected $table = 'keywords';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable =[
        'name'
    ];
}
