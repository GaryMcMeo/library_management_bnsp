<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'is_borrowed', 'member_id'];

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'book_category');
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
