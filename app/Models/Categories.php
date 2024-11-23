<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['category_name'];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_category');
    }
}
